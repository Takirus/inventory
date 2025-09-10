@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h4 class="text-center mb-4">Свяжите файлы с типом файла</h4>
            <form action="{{ route('admin.equipments.linking.store', ['equipment' => $equipment]) }}" method="POST">
                @csrf
                <input type="hidden" name="equipment_id" value="{{$equipment}}">
                @foreach ($files as $i => $file)
                <div>
                    <span>{{ $file['name'] }}</span>

                    <input type="hidden" name="equipment_files[{{ $i }}][path]" value="{{ $file['path'] }}">

                    <select name="equipment_files[{{ $i }}][type_id]">
                        @foreach ($fileTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach

                <br>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Связать</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection