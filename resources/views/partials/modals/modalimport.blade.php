<dialog id="modal_import" class="modal">
    <div>
        <form action="{{ route('petakerawanan.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="drag-area h-[300px] overflow-hidden">
                <div class="icon">
                    <i class="fa fa-files-o" aria-hidden="true"></i>
                </div>
                <div class="fileinfo">
                    <p></p>
                </div>
                <div id="result" class="flex items-center justify-center bg-contain"></div>
                <span class="header">Drag & Drop</span>
                <span class="header">atau <span class="button">Cari</span></span>
                <input type="file" name="file" id="file-input" required hidden>
            </div>
            <div class="mt-7 sm:flex-row flex flex-row-reverse gap-4">
                <button class="btn-primary-form">Import</button>
                <button type="button" onclick="modal_import.close()" class="btn-back-form">Batal</button>
            </div>
        </form>
    </div>
</dialog>