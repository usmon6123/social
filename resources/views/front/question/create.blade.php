<x-app-layout>
    <div class="m-auto w-12/12 sm:max-w-md mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <div class=" bg-blue-200 p-2 pl-6">Yangi savol so'rang!</div>

        <div class="px-6 py-4">
            <form method="POST" action="">
                @csrf

                <!-- Email Address -->


                <div class="mt-4">
                    <label>Soru başlıki(sarlavha|title) </label>
                    <x-text-input type="text" name="tags" class="block mt-1 w-full" required autofocus/>
                </div>

                <div class="mt-4 ">
                    <label>kategorya tanlang </label><br>
                    <div class="flex flex-wrap p-2 border-2 rounded-md block mt-1 w-full">
                        @foreach($categories as $key => $value)
                            <div class="w-full sm:w-1/2 md:w-1/3  px-2">
                                {{$value['name']}}
                                <input type="checkbox" name="category[]" value="{{$value['id']}}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <label>Savolingiz </label><br>
                    <textarea name="text" rows="10" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                </div>

                <div class="mt-4">
                    <label>etiketler(yorliqlar|tags) </label>
                    <x-text-input type="text" name="tags" class="block mt-1 w-full" required autofocus/>
                </div>


                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
