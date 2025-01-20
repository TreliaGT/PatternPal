<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Crafting Techniques Guide
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-center mb-6">Crafting Techniques Guide</h3>
                    <p class="mb-4 text-center">Learn about various crafting techniques including Knitting, Crochet, Weaving, Sewing, Embroidery, and Felting. Navigate through the tabs below to explore different techniques and terminology for each craft.</p>
                    
                    <!-- Tabs Navigation -->
                    <div class="mb-4">
                        <ul class="flex flex-wrap border-b border-gray-300 dark:border-gray-700">
                            <li class="mr-1">
                                <a href="#knitting" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Knitting
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#crochet" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Crochet
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#weaving" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Weaving
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#sewing" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Sewing
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#embroidery" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Embroidery
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#crossstitch" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Cross Stitch
                                </a>
                            </li>
                            <li class="mr-1">
                                <a href="#felting" class="tab block py-2 px-4 rounded-t-lg hover:text-blue-500 text-center sm:text-left bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200">
                                    Felting
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div id="knitting" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Knitting</h4>
                    </div>

                    <div id="crochet" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Crochet</h4>
                        <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left border border-gray-300 dark:border-gray-700">Term</th>
                                    <th class="px-4 py-2 text-left border border-gray-300 dark:border-gray-700">US</th>
                                    <th class="px-4 py-2 text-left border border-gray-300 dark:border-gray-700">UK</th>
                                    <th class="px-4 py-2 text-left border border-gray-300 dark:border-gray-700">Chinese</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Chain</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">ch</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">ch</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">ch</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Slip Stitch</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">slst / sl</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">slst / sl</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">sl</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Single Crochet</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">sc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">x</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Double Crochet</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">tr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">F</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Half Double Crochet</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">hdc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">htr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">T</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Treble Crochet</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">tr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dtr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">E</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Double Treble Crochet</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dtr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">trtr / trip tr</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700"></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Decrease</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dec</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">dec / dc2tog</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">A</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Increase</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Inc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Inc</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">V</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Back loop</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">bl / blo</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">bl / blo</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700"></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Front loop</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Fl / Flo</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Fl / Flo</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700"></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Bobble</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">bl</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">bl</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700"></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">Fasten Off/ Cast Off</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">FO</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700">FO</td>
                                    <td class="px-4 py-2 border border-gray-300 dark:border-gray-700"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="weaving" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Weaving</h4>
                        <!-- Weaving content here -->
                    </div>

                    <div id="sewing" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Sewing</h4>
                    </div>

                    <div id="embroidery" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Embroidery</h4>
                    </div>

                    <div id="crossstitch" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Cross Stitch</h4>
                        <a href="https://flosscross.com/designer" target="_Blank">Create your own patterns using flosscross</a>
                        <a href="https://stitchpoint.com/eng/tool/alph/cross-stitch-writer.php" target="_blank">Create words patterns</a>
                        <!-- Cross Stitch content here -->
                    </div>
                    <div id="felting" class="tab-content hidden">
                        <h4 class="text-xl font-semibold mt-4 mb-2">Felting</h4>
                        <!-- Felting content here -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.querySelectorAll('a.tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
                document.querySelectorAll('a').forEach(tab => tab.classList.remove('bg-gray-200', 'dark:bg-gray-700'));
                const tabId = e.target.getAttribute('href').substring(1);
                document.getElementById(tabId).classList.remove('hidden');
                e.target.classList.add('bg-gray-200', 'dark:bg-gray-700');
            });
        });
    </script>
</x-app-layout>
