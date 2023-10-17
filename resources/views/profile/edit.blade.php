@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="bg-white rounded-lg shadow overflow-hidden max-w-md">
            <div class="p-4">
                <h1 class="text-2xl font-semibold">プロフィール編集http://localhost:8000/profile/edit</h1>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mt-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">名前</label>
                        <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('name', auth()->user()->name) }}" required autofocus />
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Eメール</label>
                        <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('email', auth()->user()->email) }}" required />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

