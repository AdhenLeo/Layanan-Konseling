<dialog id="modal_accept" class="modal">
    <div>
        <p class="text-[17px] font-bold">Terima Pertemuan</p>
        <form action="">
            <div class="mt-5">
                <p class="font-semibold text-base text-non-active mb-2">Tanggal Pertemuan</p>
                <input type="date" class="input-form" name="tgl" required autocomplete="off">
            </div>
            <div class="mt-5">
                <p class="font-semibold text-base text-non-active mb-2">Tempat Pertemuan</p>
                <textarea class="input-form" name="tmpt_pertemuan" cols="40" required></textarea>
            </div>
            <div class="mt-7 flex gap-4">
                <button class="btn-primary-form">{{ isset($data) ? 'Ubah' : 'Kirim' }}</button>
                <button onclick="modal_accept.close()" type="button" class="btn-back-form">Tutup</button>
            </div>
        </form>
    </div>
</dialog>