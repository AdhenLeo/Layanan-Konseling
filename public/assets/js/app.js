class Component {
    static liveImage = (input) => {
        console.log(input)
        let imageBox = document.getElementById('result')
        imageBox.innerHTML = ''
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            reader.onload = function (e) {
                //e.target.result
                var productImage = new Image()
                productImage.src = e.target.result
                imageBox.appendChild(productImage)
            }
    
            reader.readAsDataURL(input.files[0])
            document.getElementById("box").classList.add("hidden")
            return true
        }else{
            document.getElementById("box").classList.remove("hidden")
        }
    }
    
    static showAlert = (message, type) => {
        if(type == 'success'){
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'topRight'
            });
        }else if(type == 'error'){
            iziToast.error({
                title: 'Failed',
                message: message,
                position: 'topRight',
            });
        }else if(type == 'info'){
            iziToast.info({
                title: 'Info',
                message: message,
                position: 'topRight'
            });
        }
    }

    static showDataPetaKerawanan = ({route: route}) => {
        // console.log(route)
        $.ajax({
            type: "GET",
            url: route,
            success: function (res) {
                // console.log(res);
                $('#checkboxpeta').html(res);
            }
        });
    }

    static showPetaKerawanan = ({route: route}) => {
        // console.log(route)
        $.ajax({
            type: "GET",
            url: route,
            success: function (res) {
                // console.log(res);
                $('#result-tags').html(res);
            }
        });
    }

    static deletePetaKerawanan = ({route: route, token: token, routeshow: routeshow, routepeta: routepeta}) => {
        console.log(routeshow)
        $.ajax({
            type: "DELETE",
            url: route,
            data: {
                _token: token,
            },
            success: function (res) {
                if(res == "msg_success") {
                    Component.showAlert('Berhasil menghapus peta kerawanan pada siswa', 'success')
                    Component.showPetaKerawanan({route: routeshow})
                    Component.showDataPetaKerawanan({route: routepeta})
                }
            }
        });
    }

    static showKelas = ({route: route}) => {
        // console.log(route)
        $.ajax({
            type: "GET",
            url: route,
            success: function (res) {
                console.log(res);
                $('#kelas_id').html(`<option value="1" hidden>XI PPLG 1</option>
                <option value="2" hidden>XI PPLG 2</option>
                <option value="3" >XI PPLG 3</option>
                <option value="4" >XI PPLG 4</option>`);
            }
        });
    }

    static showKelasGuru = ({route: route}) => {
        // console.log(route)
        $.ajax({
            type: "GET",
            url: route,
            success: function (res) {
                // console.log(res);
                $('#result-tags').html(res);
            }
        });
    }

    static deleteKelasGuru = ({route: route, token: token, routeshow: routeshow}) => {
        console.log(routeshow)
        $.ajax({
            type: "DELETE",
            url: route,
            data: {
                _token: token,
            },
            success: function (res) {
                console.log(res)
                if(res == "msg_success") {
                    Component.showAlert('Berhasil menghapus kelas anda', 'success')
                    Component.showKelasGuru({route: routeshow})
                }
            }
        });
    }

    static toggleActive = (event) => {
        const divElement = event.target.parentElement;
        divElement.classList.toggle('bg-primary');
        divElement.classList.toggle('text-white');
    }
}