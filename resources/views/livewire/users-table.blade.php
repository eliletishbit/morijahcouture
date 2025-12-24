<div>
    {{--vue livewire du tableau des utilisateurs --}}
    <div>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date de création</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Photo de {{ $user->name }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                            @else
                                <i class="fas fa-user-circle fa-2x text-secondary"></i>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if($user->status === 'active')
                                <i class="fas fa-circle text-success" title="Actif"></i>
                            @else
                                <i class="fas fa-circle text-danger" title="Inactif"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>
