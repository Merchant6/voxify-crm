<form wire:submit.prevent="submit" class="p-4 rounded-lg shadow-lg mt-10">

     <div class="grid grid-cols-2 gap-4">

        <!-- First Column -->
        <div>
            <!-- Order Date -->
            <div class="mb-4">
                <label for="order_date" class="block text-white-700">Order Date</label>
                <input type="date" id="order_date" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="dd-mm-yyyy" wire:model="order_date">
                @error('order_date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient First Name -->
            <div class="mb-4">
                <label for="patient_first_name" class="block text-white-700">Patient First Name</label>
                <input type="text" id="patient_first_name" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_first_name">
                @error('patient_first_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient Last Name -->
            <div class="mb-4">
                <label for="patient_last_name" class="block text-white-700">Patient Last Name</label>
                <input type="text" id="patient_last_name" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_last_name">
                @error('patient_last_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient DOB -->
            <div class="mb-4">
                <label for="patient_dob" class="block text-white-700">Patient DOB</label>
                <input type="date" id="patient_dob" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_dob">
                @error('patient_dob') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient Address -->
            <div class="mb-4">
                <label for="patient_address" class="block text-white-700">Patient Address</label>
                <input type="text" id="patient_address" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_address">
                @error('patient_address') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient City -->
            <div class="mb-4">
                <label for="patient_city" class="block text-white-700">Patient City</label>
                <input type="text" id="patient_city" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_city">
                @error('patient_city') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Patient State -->
            <div class="mb-4">
                <label for="patient_state" class="block text-white-700">Patient State</label>
                <input type="text" id="patient_state" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_state">
                @error('patient_state') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Patient Postal Code -->
            <div class="mb-4">
                <label for="patient_postal_code" class="block text-white-700">Patient Postal Code</label>
                <input type="text" id="patient_postal_code" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_postal_code">
                @error('patient_postal_code') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patient Phone No. -->
            <div class="mb-4">
                <label for="patient_phone_no" class="block text-white-700">Patient Phone No.</label>
                <input type="text" id="patient_phone_no" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="patient_phone_no">
                @error('patient_phone_no') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Primary Insurance (Medicare) -->
            <div class="mb-4">
                <label for="primary_insurance" class="block text-white-700">Primary Insurance (Medicare)</label>
                <input type="text" id="primary_insurance" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="primary_insurance">
                @error('primary_insurance') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Policy No. -->
            <div class="mb-4">
                <label for="policy_no" class="block text-white-700">Policy No.</label>
                <input type="text" id="policy_no" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="policy_no">
                @error('policy_no') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Private Insurance -->
            <div class="mb-4">
                <label for="private_insurance" class="block text-white-700">Private Insurance</label>
                <input type="text" id="private_insurance" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="private_insurance">
                @error('private_insurance') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Private Insurance No -->
            <div class="mb-4">
                <label for="private_insurance_no" class="block text-white-700">Private Insurance No ('-')</label>
                <input type="text" id="private_insurance_no" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="private_insurance_no">
                @error('private_insurance_no') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Height -->
            <div class="mb-4">
                <label for="height" class="block text-white-700">Height</label>
                <input type="text" id="height" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="height">
                @error('height') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Weight -->
            <div class="mb-4">
                <label for="weight" class="block text-white-700">Weight</label>
                <input type="text" id="weight" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="weight">
                @error('weight') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Types of Braces -->
            <div class="mb-4">
                <label for="brace" class="block text-white-700">Brace</label>
                {{-- <input type="file" id="physician_signed_date" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm p-4" wire:model="physician_signed_date"> --}}
                <select wire:model="braces" id="brace" class="dark:bg-gray-700 mt-1 mb-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option>Select an option</option>
                    <option value="back-braces">Back Braces</option>
                    <option value="both-knee-brace">Both Knee Brace</option>
                    <option value="left-knee-brace">Left Knee Brace</option>
                    <option value="both-ankle-brace">Both Ankle Brace</option>
                    <option value="both-wrist-brace">Both Wrist Brace</option>
                    <option value="left-wrist-brace">Left Wrist Brace</option>
                    <option value="left-elbow-brace">Left Elbow Brace</option>
                    <option value="both-elbow-brace">Both Elbow Brace</option>
                </select>
                
                @error('braces') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Second Column -->
        <div>
            <!-- Physician Name -->
            <div class="mb-4">
                <label for="physician_name" class="block text-white-700">Physician Name</label>
                <input type="text" id="physician_name" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_name">
                @error('physician_name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician NPI -->
            <div class="mb-4">
                <label for="physician_npi" class="block text-white-700">Physician NPI</label>
                <input type="text" id="physician_npi" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_npi">
                @error('physician_npi') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician City -->
            <div class="mb-4">
                <label for="physician_city" class="block text-white-700">Physician City</label>
                <input type="text" id="physician_city" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_city">
                @error('physician_city') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician State -->
            <div class="mb-4">
                <label for="physician_state" class="block text-white-700">Physician State</label>
                <input type="text" id="physician_state" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_state">
                @error('physician_state') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician Postal Code -->
            <div class="mb-4">
                <label for="physician_postal_code" class="block text-white-700">Physician Postal Code</label>
                <input type="text" id="physician_postal_code" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_postal_code">
                @error('physician_postal_code') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician Number -->
            <div class="mb-4">
                <label for="physician_number" class="block text-white-700">Physician Number</label>
                <input type="text" id="physician_number" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_number">
                @error('physician_number') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician Fax Number -->
            <div class="mb-4">
                <label for="physician_fax_number" class="block text-white-700">Physician Fax Number</label>
                <input type="text" id="physician_fax_number" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm" wire:model="physician_fax_number">
                @error('physician_fax_number') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician Signature (Upload Image) -->
            <div class="mb-4">
                <label for="physician_signature" class="block text-white-700">Physician Signature (Upload Image)</label>
                <input type="file" id="physician_signature" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm p-4" wire:model="physician_signature">
                @error('physician_signature') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Physician Signed Date (Upload Image) -->
            <div class="mb-4">
                <label for="physician_signed_date" class="block text-white-700">Physician Signed Date (Upload Image)</label>
                <input type="file" id="physician_signed_date" class="dark:bg-gray-700 mt-1 block w-full border-gray-300 rounded-md shadow-sm p-4" wire:model="physician_signed_date">
                @error('physician_signed_date') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        
    </div>

    <div class="mt-4 text-right">
        <button type="submit" class="w-full px-auto py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm hover:bg-blue-600">
            Submit
        </button>

        @if (session()->has('message'))
        <x-input-success :messages="session('message')" class="mt-2" />
        @endif 

        
        @if (session()->has('error'))
            <x-input-error  :messages="session('error')" class="mt-2" />
        @endif 
    </div>

</form>