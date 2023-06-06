<dialog id="modal_riject" class="modal">
    <div>
        <p class="text-[17px] font-bold">Tolak Pertemuan</p>
        <form action="">
            <div class="flex mt-4">
                <input type="radio" id="ket" hidden name="ket" value="Sedang sibuk">
                <label for="ket" name='lbl-ket' onclick="selectedradio(this)" class="radio-non-active">
                    <p>Sedang sibuk</p>
                </label>
            </div>
            <div class="flex mt-3">
                <input type="radio" id="ket-2" hidden name="ket" value="Sedang pergi keluar">
                <label for="ket-2" name="lbl-ket" onclick="selectedradio(this)" class="radio-non-active">
                    <p>Sedang pergi keluar</p>
                </label>
            </div>
            <div class="flex mt-3">
                <input type="radio" id="ket-3" hidden name="ket" value="Sedang ada urusan">
                <label for="ket-3" name='lbl-ket' onclick="selectedradio(this)" class="radio-non-active">
                    <p>Sedang ada urusan</p>
                </label>
            </div>
            <div class="mt-2">
                <button type="button" onclick="clearradio()" class="text-[13px] font-semibold text-primary cursor-pointer">Hapus</button>
            </div>
            <div class="mt-5">
                <p class="font-semibold text-base text-non-active mb-2">Lainnya</p>
                <textarea class="input-form" name="tmpt_pertemuan" id="txtarea" cols="40" required></textarea>
            </div>
            <div class="mt-7 flex gap-4">
                <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Kirim' }}</button>
                <button onclick="modal_riject.close()" type="button" class="btn-back-form">Tutup</button>
            </div>
        </form>
    </div>
</dialog>
<script src="{{ asset('assets/js/selectradio.js') }}"></script>