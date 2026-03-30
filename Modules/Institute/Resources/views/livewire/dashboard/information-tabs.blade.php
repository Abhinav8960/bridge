<div>
    <div class="row">
        <div class="col-md-12">
            @include('institute::layouts.flash-message')
        </div>
    </div>
    <div class="d-block align-items-center pt-3 mt-auto">

        @isTabAccessable('is_showing_general')
            <div class="me-1">
                <input type="checkbox" wire:model="general" disabled><label class="m-2">General</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_courses')
            <div class="me-1">
                <input type="checkbox" wire:model="courses"><label class="m-2">Courses</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_champions')
            <div class="me-1">
                <input type="checkbox" wire:model="champions"><label class="m-2">Champions</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_uploads')
            <div class="me-1">
                <input type="checkbox" wire:model="uploads"><label class="m-2">Uploads</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_faculty')
            <div class="me-1">
                <input type="checkbox" wire:model="faculty"><label class="m-2">Faculty</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_centers')
            <div class="me-1">
                <input type="checkbox" wire:model="centers" disabled><label class="m-2">Centers</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_videos')
            <div class="me-1">
                <input type="checkbox" wire:model="videos"><label class="m-2">Videos</label>
            </div>
        @endisTabAccessable
        @isTabAccessable('is_showing_alumni')
            <div class="me-1">
                <input type="checkbox" wire:model="alumni"><label class="m-2">Alumni</label>
            </div>
        @endisTabAccessable







    </div>
</div>
