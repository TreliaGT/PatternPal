<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pattern;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Auth;

class PatternController extends Controller
{
    public function index(Request $request){
        $patterns = Pattern::paginate(12);
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => "Dashboard",
            'categories' => $categories,
            'tags' =>  $tags
        ]);
    }

    public function create(Request $request){
        $categories = Category::all();
        $Tags = Tag::all();

        return view('patterns.create' ,[
            'categories' =>  $categories,
            'tags' =>  $Tags,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'feature_image_url' => 'nullable|url',
            'materials' => 'required|string',
            'pdk_link' => 'nullable|url',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'youtube_link' => 'nullable|url',
            'tags' => 'array', // Ensure tags are an array
            'tags.*' => 'exists:tags,id', // Ensure each tag ID exists in the tags table
            'steps' => 'nullable|array', // Ensure steps is an array
            'steps.*.title' => 'nullable|string|max:255',
            'steps.*.step' => 'nullable|string',
        ]);

        $image_url = $request->feature_image_url;
          // Handle file upload for feature image
        $featureImagePath = null;
        if ($request->hasFile('feature_image')) {
            $featureImage = $request->file('feature_image');
            $featureImagePath = $featureImage->store('images', 'public'); // Store image in 'public/images' directory
            $image_url =  $featureImagePath;
        }

        $pdfimagepath = $request->pdk_link;
        if ($request->hasFile('pdf_file')) {
            $pdfFile = $request->file('pdf_file');
            $pdf_path = $pdfFile->store('pdfs', 'public'); // Store PDF in 'public/pdfs' directory
            $pdfimagepath =  $pdf_path;
        }

        // Create and save the new pattern
        $pattern = Pattern::create([
            'title' => $request->title,
            'feature_image_url' =>  $image_url,
            'category_id' => $request->category_id,
            'materials' => $request->materials,
            'pdk_link' => $pdfimagepath,
            'youtube_link' => $request->youtube_link,
            'user_id' => Auth::user()->id,
        ]);
    
        // Attach the selected tags
        if ($request->has('tags')) {
            $pattern->tags()->attach($request->tags);
        }

        if($request->steps){
            foreach ($request->steps as $step) {
                if(isset($step['title']) && isset($step['step'])){
                    $pattern->steps()->create([
                        'title' => $step['title'],
                        'steps' => $step['step'],
                    ]);
                }
            }
        }
        return redirect()->route('patterns.show', ['pattern' => $pattern->id])
        ->with('success', 'Pattern created successfully!');
    }

    public function show($pattern_id)
    {
        $pattern = Pattern::findorfail($pattern_id);
        return view('patterns.show', compact('pattern'));
    }


    public function edit(Pattern $pattern)
    {
        // Get all categories and tags to populate the select options
        $categories = Category::all();
        $tags = Tag::all();

        return view('patterns.edit', compact('pattern', 'categories', 'tags'));
    }


    public function update(Request $request, Pattern $pattern)
    {
        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'materials' => 'required|string',
            'pdf_link' => 'nullable|url', // Optional: URL for PDF link
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
            'youtube_link' => 'nullable|url',
            'feature_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'tags' => 'array|nullable',
            'tags.*' => 'exists:tags,id',
            'steps' => 'array|nullable',
            'steps.*.title' => 'nullable|string|max:255',
            'steps.*.step' => 'nullable|string',
        ]);

        // Update the pattern details
        $pattern->title = $validated['title'];
        $pattern->category_id = $validated['category_id'];
        $pattern->materials =  $validated['materials'];
        if( isset($validated['pdk_link'])){
            $pattern->pdk_link = $validated['pdk_link'];
        }
        if( isset($validated['youtube_link'])){
            $pattern->youtube_link = $validated['youtube_link'];
        }

        // Handle feature image upload if present
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($pattern->feature_image) {
                Storage::delete('public/' . $pattern->feature_image);
            }

            // Store the new image
            $imagePath = $request->file('feature_image')->store('patterns', 'public');
            $pattern->feature_image = $imagePath;
        }

        if ($request->hasFile('pdf_file')) {
            // Delete old PDF file if exists
            if ($pattern->pdf_file) {
                Storage::delete('public/' . $pattern->pdf_file);
            }
        
            // Store the new PDF file
            $pdfPath = $request->file('pdf_file')->store('patterns', 'public');
            $pattern->pdk_link = $pdfPath;
        }
        // Save the pattern
        $pattern->save();

        // Sync the tags
        if ($request->has('tags')) {
            $pattern->tags()->sync($validated['tags']);
        }

        // Handle the steps (if any)
        if ($request->has('steps')) {
            $steps = $validated['steps'];

            // Remove existing steps before saving
            $pattern->steps()->delete();
        
            foreach ($steps as $step) {
                if(isset($step['title']) && isset($step['step'])){
                    $pattern->steps()->create([
                        'title' => $step['title'],
                        'steps' => $step['step'],
                    ]);
                }
            }
        }

        return redirect()->route('patterns.show', $pattern->id)->with('success', 'Pattern updated successfully!');
    }

    public function destroy(Pattern $pattern)
    {
        // You may want to check if the user is authorized to delete the pattern
        // $this->authorize('delete', $pattern);

        // Delete the associated feature image from storage (if it exists)
        if ($pattern->feature_image_url) {
            $imagePath = storage_path('app/public/' . $pattern->feature_image_url);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Deletes the image from storage
            }
        }

        if ($pattern->pdk_link) {
            $pdkPath = storage_path('app/public/' . $pattern->pdk_link);
            if (file_exists($pdkPath)) {
                unlink($pdkPath); // Deletes the image from storage
            }
        }

        // Delete the pattern record from the database
        $pattern->delete();

        // Redirect to the patterns index or a specific page with a success message
        return redirect()->route('dashboard')->with('success', 'Pattern deleted successfully.');
    }

    public function profile_pattern($user_name){
        $user = User::where('name', $user_name)->first();
        if (!$user) {
            return redirect()->route('dashboard')->with('error', 'User not found');
        }
        
        $patterns = Pattern::where('user_id', $user->id)->paginate(12);
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => $user->name
        ]);
    }

    /**
     * Show patterns for a specific category.
     */
    public function showCategory(Category $category)
    {
        // Get the patterns for the given category
        $patterns = $category->patterns()->paginate(12);
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => $category->name,
        ]);
    }

    /**
     * Show patterns for a specific tag.
     */
    public function showTag(Tag $tag)
    {
        // Get the patterns for the given tag
        $patterns = $tag->patterns()->paginate(12);
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => $tag->name,
        ]);
    }

    public function listTag(){
        $tags = Tag::all();
        return view('patterns.list', [
            'tags' =>  $tags,
            'title' => "Tags"
        ]);
    }

    public function listCategory(){
        $categories = Category::all();
        return view('patterns.list', [
            'categories' =>  $categories,
            'title' => "Categories"
        ]);
    }

    public function showMyPatterns()
    {
        // Get patterns created by the authenticated user
        $patterns = Auth::user()->patterns()->paginate(12);

        // Return the view with the patterns
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => "My Patterns"
        ]);
    }


    public function search(Request $request){
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $tagIds = $request->input('tags', []);

        $patterns = Auth::user()->patterns();

        // Search by title if 'search' parameter exists
        if ($search) {
            $patterns = $patterns->where('title', 'like', '%' . $search . '%');
        }

        // Filter by category if 'category' parameter exists
        if ($categoryId) {
            $patterns = $patterns->where('category_id', $categoryId);
        }

        // Filter by tags if 'tags' parameter exists
        if (!empty($tagIds)) {
            $patterns = $patterns->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            });
        }

        // Paginate the results
        $patterns = $patterns->paginate(12);

        // Get categories and tags for the dropdowns
        $categories = Category::all();
        $tags = Tag::all();

        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => "Search",
            'categories' => $categories,
            'tags' =>  $tags
        ]);
    }


    public function like(Pattern $pattern)
    {
        $pattern->likedByUsers()->attach(auth()->id());

        return back(); // Redirect back to the pattern page
    }

    public function unlike(Pattern $pattern)
    {
        $pattern->likedByUsers()->detach(auth()->id());

        return back(); // Redirect back to the pattern page
    }

    public function likedPatterns(){
        $patterns = Auth::user()->likedPatterns()->paginate(12);

        // Return the view with the patterns
        return view('dashboard', [
            'patterns' =>  $patterns,
            'title' => "Liked Patterns"
        ]);
    }

    /** Guide */
    public function guide(){
        return view('patterns.guide');
    }
}
