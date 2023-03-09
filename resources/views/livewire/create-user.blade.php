<div>
    <form class="p-10 bg-white rounded shadow-xl" wire:submit.prevent="saveUser">
        @csrf
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="name">Name</label>
            <input value="{{ old('name') }}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                name="name" type="text" placeholder="Name" aria-label="Name" wire:model.lazy="name">
        </div>
        @error('name')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="username">Username</label>
            <input value="{{ old('username') }}" class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                id="username" name="username" type="text" placeholder="Username" aria-label="Username"
                wire:model.lazy="username">
        </div>
        @error('username')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Email</label>
            <input value="{{ old('email') }}" class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded"
                id="email" name="email" type="text" placeholder="Your Email" aria-label="Email"
                wire:model.lazy="email">
        </div>
        @error('email')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="password">Password</label>
            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="password" name="password"
                type="password" placeholder="password" aria-label="password" wire:model.lazy="password">
        </div>
        @error('password')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="role">Role</label>
            <select value="{{ old('role') }}" class="w-full px-5 py-3 text-gray-700 bg-gray-200 rounded"
                id="role" name="role" type="text" wire:model="role">
                <option value="">-- Select role --</option>
                <option value="DM">DM</option>
                <option value="MPR">MPR</option>
                <option value="MM">MM</option>
                <option value="RSM">RSM</option>
                <option value="KAE">KAE</option>
                <option value="AS">AS</option>
                <option value="MR">MR</option>
            </select>
        </div>
        @error('role')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="reporting_manager">Reporting Manager</label>
            <input value="{{ old('reporting_manager') }}" class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded"
                id="reporting_manager" name="reporting_manager" type="text" placeholder="Reporting Manager"
                aria-label="Reporting Manager" wire:model.lazy="reporting_manager">
        </div>
        @error('reporting_manager')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Reporting Manager Manager</label>
            <input value="{{ old('reporting_manager_manager') }}"
                class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" id="reporting_manager_manager"
                name="reporting_manager_manager" type="text" placeholder="Reporting Manager Manager"
                aria-label="Reporting Manager Manager" wire:model.lazy="reporting_manager_manager">
        </div>
        @error('reporting_manager_manager')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Rayon atau Area</label>
            <input value="{{ old('rayon') }}" class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded"
                id="rayon" name="rayon" type="text" placeholder="Rayon atau area" aria-label="Rayon atau area"
                wire:model.lazy="rayon">
        </div>
        @error('rayon')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <label class="block text-sm text-gray-600" for="email">Regional atau Divisi</label>
            <input value="{{ old('regional') }}" class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded"
                id="regional" name="regional" type="text" placeholder="Regional atau divisi"
                aria-label="Regional atau divisi" wire:model.lazy="regional">
        </div>
        @error('regional')
            <div class="text-xs w-100 text-red-500 italic mt-2">{{ $message }}</div>
        @enderror

        <div class="mt-6">
            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                type="submit">Submit</button>
        </div>
    </form>
</div>
