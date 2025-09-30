@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Add File</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.elibrary.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Program --}}
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select id="program" name="program" class="form-control" required>
                                <option value="">-- Select Program --</option>
                                <option value="Kemahiran Elektrik"
                                    {{ old('program') == 'Kemahiran Elektrik' ? 'selected' : '' }}>
                                    KEMAHIRAN ELEKTRIK
                                </option>
                                <option value="Kemahiran Mekatronik"
                                    {{ old('program') == 'Kemahiran Mekatronik' ? 'selected' : '' }}>
                                    KEMAHIRAN MEKATRONIK
                                </option>
                            </select>
                        </div>

                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Save
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
