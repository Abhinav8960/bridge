<div>

    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="exam">
        <thead>
            <tr>
                <th scope="col">#</th>
                {{-- <th scope="col">Module Sequence</th> --}}
                <th scope="col">Module Title</th>
                <th scope="col">Module Description</th>
                <th scope="col">Date Created</th>
                <th scope="col">Date Updated</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody wire:sortable="updateSequenceOrder">
            @if ($terms->count() > 0)
                @foreach ($terms as $term)
                    <tr wire:sortable.item="{{ $term->id }}">
                        <td scope="col" wire:sortable.handle style="width: 10px; cursor: move;"><i
                                class="fa fa-arrows-alt text-muted"></i></td>
                        {{-- <td scope="col">{{ $term->module_sequence }}</td> --}}
                        <td scope="col">{{ $term->module_title }}</td>
                        <td scope="col">{!! $term->module_description !!}</td>
                        {{-- <td scope="col"><span
                            class="btn btn-rounded {{ $term->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $term->status == 1 ? 'Active' : 'Suspended' }}</span>
                    </td> --}}
                        <td scope="col">
                            {{ \Carbon\Carbon::parse($term->created_at)->format('d-m-Y h:i A') }}
                        </td>
                        <td scope="col">
                            {{ \Carbon\Carbon::parse($term->updated_at)->format('d-m-Y h:i A') }}
                        </td>
                        <td scope="col">
                            <a href="{{ route('configuration.termanduse.edit', $term->id) }}"
                                class="btn btn-sm btn-primary" style="float: left" data-bs-placement="top"
                                title="Update"><i class="fa fa-edit"></i></a>

                            <form style="float: left;margin-left:10px;" method="post"
                                action="{{ route('configuration.termanduse.destroy', $term->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"
                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                        class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th colspan="12">No Record Found</th>
                </tr>
            @endif

        </tbody>
    </table>

</div>
