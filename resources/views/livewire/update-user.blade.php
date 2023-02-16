<form class="p-10 bg-white rounded shadow-xl" wire:submit.prevent="updateUser">
    @csrf
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="name">Name</label>
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
            name="name" type="text" placeholder="Name" aria-label="Name" wire:model="name">
    </div>
    @error('name')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="username">Username</label>
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="username"
            name="username" type="text" placeholder="Username" aria-label="Username" wire:model="username">
    </div>
    @error('username')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="email">Email</label>
        <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="email"
            name="email" type="text" placeholder="Your Email" aria-label="Email" wire:model="email">
    </div>
    @error('email')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="password">Password</label>
        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password" type="password"
            placeholder="password" aria-label="password" wire:model="password">
    </div>
    @error('password')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="role_id">Role</label>
        <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded" id="role_id"
            name="role_id" type="text" wire:model="role_id">
            <option value="">-- Select role --</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    @error('role')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="reporting_manager">Reporting Manager</label>
        <select class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded"
            id="reporting_manager" name="reporting_manager" wire:model="reporting_manager">
            <option value="">-- Select role --</option>
            @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
    </div>
    @error('reporting_manager')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="email">Rayon atau Area</label>
        <input
            class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="rayon" name="rayon" type="text"
            placeholder="Rayon atau area" aria-label="Rayon atau area" wire:model="rayon">
    </div>
    @error('rayon')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <label class="block text-sm text-gray-600" for="email">Regional atau Divisi</label>
        <input 
            class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="regional" name="regional" type="text"
            placeholder="Regional atau divisi" aria-label="Regional atau divisi"  wire:model="regional">
    </div>
    @error('regional')
        <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
    @enderror
    <div class="mt-6">
        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
            type="submit">Submit</button>
    </div>
</form>
