    @foreach ($datas as $data)
        <option value="{{ $data->id }}" {{ in_array($data->id, $kelas) ? 'hidden' : '' }}>{{ $data->nama }}</option>
    @endforeach