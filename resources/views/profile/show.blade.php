<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif

            @if (Auth::user()->role === 'admin')
                <x-section-border />
                <div class="mt-10 sm:mt-0">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ __('Pending Role Change Requests') }}
                    </h3>
                    @if ($pendingRequests->isEmpty())
                        <p class="mt-4 text-sm text-gray-600">
                            {{ __('There are no pending role change requests at the moment.') }}
                        </p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('User') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Current Role') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Requested Role') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pendingRequests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $request->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $request->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $request->pending_role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.approve-role-change', $request) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.deny-role-change', $request) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Deny</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
