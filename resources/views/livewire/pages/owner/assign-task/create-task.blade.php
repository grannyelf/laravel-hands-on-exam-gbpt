<div>
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="mt-12 max-w-full mx-auto">
            <!-- Card -->
            <div class="flex flex-col border border-gray-200 rounded-xl p-4 sm:p-6 lg:p-8 dark:border-neutral-700">
                <h2 class="mb-8 text-xl font-semibold text-gray-800 dark:text-neutral-200">
                    Create Task
                </h2>
                @if (session()->has('success'))
                    <div class="flex justify-center">
                        <div class="p-3 w-80 mb-5 rounded-4xl bg-black text-center text-green-500">
                            <h1>{{ session('success') }}</h1>
                        </div>
                    </div>
                @endif
                <form wire:submit.prevent="save">
                    <div class="grid gap-4 lg:gap-6">
                        <!-- Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="hs-title"
                                    class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Title</label>
                                <input wire:model.defer="title" type="text" name="hs-title" id="hs-title"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @error('title')
                                    <div>
                                        <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                            <div>
                                <label for="hs-description"
                                    class="block mb-2 text-sm text-gray-700 font-medium dark:text-white">Description</label>
                                <textarea wire:model.defer="description" name="hs-description" id="hs-description"
                                    class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                                @error('description')
                                    <div>
                                        <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5">
                            <h2 class="mb-1 text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                Assign User
                            </h2>

                        </div>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-2">
                            @forelse ($this->users as $uKey => $user)
                                <label wire:key='{{ $uKey }}' for="hs-checkbox-in-form-{{ $uKey }}"
                                    class="flex items-center p-3 w-full bg-layer border dark:border-neutral-700 border-layer-line rounded-lg text-sm focus:border-primary-focus focus:ring-primary-focus">
                                    <input type="checkbox" name="user_ids[]"
                                        id="hs-checkbox-in-form-{{ $uKey }}" wire:model.defer="user_ids"
                                        value="{{ $user->id }}"
                                        class="h-4 w-4 border-gray-300 rounded text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm ms-3 text-muted-foreground-1 dark:text-amber-50">
                                        {{ $user->name }}
                                    </span>

                                </label>
                            @empty
                                <p>No Users Found</p>
                            @endforelse

                            @error('user_ids')
                                <div>
                                    <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <!-- End Grid -->

                    <div class="mt-6 grid">
                        <button type="submit"
                            class="w-50 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Save</button>
                    </div>

                </form>
            </div>
            <!-- End Card -->
        </div>
    </div>
    <!-- End Contact Us -->
</div>
