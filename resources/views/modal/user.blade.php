<!--Edit User -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Update User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

            <div id='pleaseWaitEdit' class="text-center" style="display: none"><img class="m-auto" src='https://media.giphy.com/media/feN0YJbVs0fwA/giphy.gif'/></div>
            <form id="editUserForm" action="{{ route('users.update-profile') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="container-fluid">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="editUsername" value="{{ $user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="job">Jobs</label>
                                <select name="job" id="job" class="form-control">
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}" selected>
                                            {{ $job->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if (isset($skills))
                                @if ($skills->count() > 0)
                                <div class="form-group">
                                    <label for="skills">Skills</label>
                                    <select name="skills[]" id="skills" class="form-control skills-selector" multiple="multiple" data-placeholder="Select Skill" style="width: 100%;">
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}"
                                                @if (isset($user))
                                                    @if ($user->hasSkill($skill->id))
                                                        selected
                                                    @endif
                                                @endif
                                                >
                                                {{ $skill->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update User</button>
                </div>
                <div class="lock-modal"></div>
                <div class="loading-circle"></div>
            </form>
        </div>
    </div>
</div>
