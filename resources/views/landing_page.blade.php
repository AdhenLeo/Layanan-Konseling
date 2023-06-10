<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Quicksand:wght@600&display=swap"
        rel="stylesheet">
    {{-- alert --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      @keyframes increaseHeight {
        from {
          height: 0;
          margin-top: 0px;
        }
        to {
          height: 120px;
          margin-top: 12px;
        }
      }
      @keyframes decreaseHeight {
        from {
          height: 120px;
          margin-top: 12px;
        }
        to {
          height: 0;
          margin-top: 0px;
        }
      }
      .up{
        animation-name: increaseHeight;
        animation-duration: 0.3s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
      }
      .down{
        animation-name: decreaseHeight;
        animation-duration: 0.3s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
      }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/iziAlert.js') }}"></script>
    {{-- multiple select --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">
    {{-- jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
    @stack('css')
</head>

<body class="font-nunito overflow-visible">
  {{-- <div class="bg-blue-500 sm:bg-green-500 md:bg-yellow-500 lg:bg-red-500 xl:bg-purple-500">
    <p class="">
      ini adalah
      <span class="hidden md:inline">md</span>
      <span class="hidden sm:inline md:hidden">sm</span>
      <span class="hidden sm:hidden md:hidden lg:inline">lg</span>
      <span class="hidden sm:hidden md:hidden lg:hidden xl:inline">xl</span>
    </p>
  </div> --}}
  <nav class="px-3 lg:px-14 py-5 ">
    <div class="flex justify-between items-center">
      <div class="sm:hidden block cursor-pointer" onclick="
          if(mobile_bar.classList.contains('active')){
            mobile_bar.classList.remove('down');
            mobile_bar.classList.add('up');
          } 
          if(!mobile_bar.classList.contains('active')){
            mobile_bar.classList.add('down');
            mobile_bar.classList.remove('up');
          }
          mobile_bar.classList.toggle('active')
          // mobile_bar.classList.toggle('down');
        " id="menu">
        <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M4.7395 10.2083C4.7395 9.91826 4.85474 9.64006 5.05985 9.43495C5.26497 9.22983 5.54317 9.11459 5.83325 9.11459H29.1666C29.4567 9.11459 29.7349 9.22983 29.94 9.43495C30.1451 9.64006 30.2603 9.91826 30.2603 10.2083C30.2603 10.4984 30.1451 10.7766 29.94 10.9817C29.7349 11.1869 29.4567 11.3021 29.1666 11.3021H5.83325C5.54317 11.3021 5.26497 11.1869 5.05985 10.9817C4.85474 10.7766 4.7395 10.4984 4.7395 10.2083ZM4.7395 17.5C4.7395 17.2099 4.85474 16.9317 5.05985 16.7266C5.26497 16.5215 5.54317 16.4063 5.83325 16.4063H21.8749C22.165 16.4063 22.4432 16.5215 22.6483 16.7266C22.8534 16.9317 22.9687 17.2099 22.9687 17.5C22.9687 17.7901 22.8534 18.0683 22.6483 18.2734C22.4432 18.4785 22.165 18.5938 21.8749 18.5938H5.83325C5.54317 18.5938 5.26497 18.4785 5.05985 18.2734C4.85474 18.0683 4.7395 17.7901 4.7395 17.5ZM4.7395 24.7917C4.7395 24.5016 4.85474 24.2234 5.05985 24.0183C5.26497 23.8132 5.54317 23.6979 5.83325 23.6979H13.1249C13.415 23.6979 13.6932 23.8132 13.8983 24.0183C14.1034 24.2234 14.2187 24.5016 14.2187 24.7917C14.2187 25.0818 14.1034 25.36 13.8983 25.5651C13.6932 25.7702 13.415 25.8854 13.1249 25.8854H5.83325C5.54317 25.8854 5.26497 25.7702 5.05985 25.5651C4.85474 25.36 4.7395 25.0818 4.7395 24.7917Z"
                fill="black" />
        </svg>
      </div>
      <h1 class="font-extrabold text-2xl text-primary-landing">Deep<span class="text-yellow-landing">Talk</span></h1>
      <div class="font-semibold text-primary hidden w-1/2 lg:w-1/3 sm:flex justify-between">
        <a href="">How to Konsul</a>
        <a href="">Podcast</a>
        <a href="">About Us</a>
      </div>
      <a href="" class="px-14 rounded-lg py-2 bg-yellow-landing text-white ">Login</a>
    </div>
    <div id="mobile_bar" class="active flex flex-col h-0 overflow-hidden justify-between font-semibold text-primary">
      <a href="" class="p-2">How to Konsul</a>
      <a href="" class="p-2">Podcast</a>
      <a href="" class="p-2">About Us</a>
    </div>
  </nav>
  <div class="bg-gradient-to-b from-[#4267AD] via-[#4267AD] to-[#4267AD] w-full h-[80vh] max-h-[650px]"></div>
  <div class="text-center items-center flex flex-col my-14 space-y-6"> 
    <div class="w-16 h-2 bg-yellow-landing rounded-full"></div>
    <h1 class="text-2xl">Kenapa pakai TB-BK?</h1>
    <p class=" w-2/3 md:w-2/5">Kami akan membantu kamu mulai dari berbagai aspek yang mencangkup banyak masalah internal ataupun eksternal</p>
  </div>
  <div class="flex flex-col items-center lg:flex-row justify-around xl:px-32 px-5 md:px-10 my-24 space-y-5">
    <div class="flex lg:w-fit lg:space-x-2 space-x-4">
      <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.15527 10C4.15527 8.93913 4.59306 7.92172 5.37233 7.17157C6.15159 6.42143 7.20851 6 8.31055 6H22.854C23.9561 6 25.013 6.42143 25.7923 7.17157C26.5715 7.92172 27.0093 8.93913 27.0093 10V18C27.0093 19.0609 26.5715 20.0783 25.7923 20.8284C25.013 21.5786 23.9561 22 22.854 22H18.6988L12.4658 28V22H8.31055C7.20851 22 6.15159 21.5786 5.37233 20.8284C4.59306 20.0783 4.15527 19.0609 4.15527 18V10Z" fill="#4267AD"/>
        <path d="M31.1647 14V18C31.1647 20.1217 30.2891 22.1566 28.7306 23.6569C27.172 25.1571 25.0582 26 22.8541 26H20.4191L16.75 29.534C17.3317 29.832 17.9945 30 18.6988 30H22.8541L29.087 36V30H33.2423C34.3444 30 35.4013 29.5786 36.1805 28.8284C36.9598 28.0783 37.3976 27.0609 37.3976 26V18C37.3976 16.9391 36.9598 15.9217 36.1805 15.1716C35.4013 14.4214 34.3444 14 33.2423 14H31.1647Z" fill="#4267AD"/>
      </svg>
      <div class="lg:max-w-[240px] max-w-[300px]">
        <h3 class="font-semibold text-base mb-2">Kesulitan Interaksi Sosial</h3>
        <p class="font-medium text-xs leading-6 flex items-center justify-center text-justify">Untuk Kamu memiliki masalah sulit berbicara, mengatakan suatu hal pada orang lain dan merasa sulit sekali bergaul.</p>
      </div>
    </div>
    <div class="flex lg:w-fit lg:space-x-2 space-x-4">
      <svg width="42" height="40" viewBox="0 0 42 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M31.0448 18.3333C33.5616 18.3333 35.8926 19.1166 37.8013 20.4333V13.3333C37.8013 11.4833 36.298 9.99992 34.423 9.99992H27.6665V6.66659C27.6665 4.81659 26.1632 3.33325 24.2882 3.33325H17.5317C15.6567 3.33325 14.1534 4.81659 14.1534 6.66659V9.99992H7.39683C5.52189 9.99992 4.03545 11.4833 4.03545 13.3333L4.01855 31.6666C4.01855 33.5166 5.52189 34.9999 7.39683 34.9999H20.3694C19.5124 33.2224 19.1255 31.2598 19.2447 29.295C19.3639 27.3301 19.9853 25.4271 21.0511 23.7631C22.1169 22.0992 23.5923 20.7287 25.3397 19.7792C27.0872 18.8298 29.0499 18.3323 31.0448 18.3333ZM17.5317 6.66659H24.2882V9.99992H17.5317V6.66659Z" fill="#4267AD"/>
        <path d="M31.0448 21.6667C26.3828 21.6667 22.5991 25.4001 22.5991 30.0001C22.5991 34.6001 26.3828 38.3334 31.0448 38.3334C35.7068 38.3334 39.4905 34.6001 39.4905 30.0001C39.4905 25.4001 35.7068 21.6667 31.0448 21.6667ZM33.8319 33.9167L30.2002 30.3334V25.0001H31.8894V29.6501L35.0143 32.7334L33.8319 33.9167Z" fill="#4267AD"/>
      </svg>        
      <div class="lg:max-w-[240px] max-w-[300px]">
        <h3 class="font-semibold text-base mb-2">Susah kelola waktu</h3>
        <p class="font-medium text-xs leading-6 flex items-center justify-center text-justify">Susah buat ngatur waktu belajar? main? istirahat? ini tema yang cocok banget nih!</p>
      </div>
    </div>
    <div class="flex lg:w-fit lg:space-x-2 space-x-4">
      <svg width="41" height="40" viewBox="0 0 41 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4.65322 24.5266L5.5265 27.7466C6.54674 31.5049 7.05855 33.3849 8.21561 34.6032C9.12884 35.5646 10.3103 36.2373 11.6108 36.5366C13.2594 36.9166 15.1647 36.4132 18.9754 35.4066C22.7827 34.3999 24.6881 33.8966 25.9229 32.7549C26.0242 32.6599 26.1255 32.5616 26.2201 32.4616C25.6449 32.41 25.0731 32.3265 24.5074 32.2116C23.3317 31.9816 21.9348 31.6116 20.2828 31.1749L20.1021 31.1266L20.0599 31.1166C18.2626 30.6399 16.761 30.2432 15.5617 29.8166C14.2999 29.3666 13.1547 28.8116 12.18 27.9116C10.8394 26.6722 9.90123 25.0686 9.48415 23.3032C9.18011 22.0216 9.26794 20.7649 9.50442 19.4632C9.73077 18.2149 10.1362 16.7182 10.6226 14.9266L11.5263 11.6032L11.5567 11.4866C8.31358 12.3482 6.60586 12.8582 5.46738 13.9099C4.49189 14.8117 3.80941 15.9787 3.50629 17.2632C3.12117 18.8882 3.63129 20.7682 4.65322 24.5266Z" fill="#4267AD"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M35.1845 17.8582L34.3095 21.0782C33.2876 24.8366 32.7775 26.7166 31.6204 27.9349C30.7074 28.8969 29.5259 29.5702 28.2253 29.8699C28.0614 29.9082 27.8959 29.9366 27.727 29.9566C26.1814 30.1449 24.2946 29.6466 20.8623 28.7399C17.0533 27.7316 15.1479 27.2282 13.9132 26.0866C12.938 25.1853 12.2555 24.0189 11.9521 22.7349C11.567 21.1082 12.0771 19.2299 13.099 15.4716L13.9723 12.2516L14.3845 10.7432C15.153 7.96657 15.6699 6.43824 16.6614 5.39324C17.5746 4.43191 18.7561 3.75914 20.0566 3.45991C21.7052 3.07991 23.6105 3.58324 27.4212 4.59157C31.2285 5.59824 33.1339 6.10157 34.3687 7.24157C35.3441 8.14333 36.0266 9.31033 36.3297 10.5949C36.7149 12.2216 36.2047 14.0999 35.1845 17.8582ZM18.6681 16.3416C18.7112 16.183 18.7856 16.0343 18.8869 15.9041C18.9883 15.7739 19.1146 15.6646 19.2588 15.5826C19.403 15.5006 19.5621 15.4474 19.7271 15.426C19.8921 15.4047 20.0597 15.4156 20.2204 15.4582L28.379 17.6166C28.5439 17.6552 28.6993 17.726 28.836 17.825C28.9727 17.9239 29.0879 18.0489 29.1747 18.1926C29.2616 18.3362 29.3183 18.4956 29.3415 18.6613C29.3648 18.827 29.3541 18.9956 29.3102 19.1572C29.2662 19.3187 29.1898 19.4699 29.0855 19.6018C28.9812 19.7336 28.8512 19.8435 28.7031 19.9249C28.555 20.0063 28.3918 20.0575 28.2233 20.0756C28.0547 20.0936 27.8842 20.0781 27.7219 20.0299L19.5634 17.8732C19.2391 17.7873 18.9627 17.5779 18.7949 17.291C18.627 17.0042 18.5814 16.6616 18.6681 16.3416ZM17.3573 21.1716C17.4444 20.8517 17.6567 20.5789 17.9474 20.4133C18.2381 20.2477 18.5836 20.2027 18.908 20.2882L23.8031 21.5832C23.9688 21.621 24.1252 21.6913 24.2628 21.7899C24.4004 21.8886 24.5165 22.0135 24.6041 22.1574C24.6917 22.3012 24.749 22.461 24.7727 22.6272C24.7964 22.7934 24.7859 22.9626 24.7419 23.1248C24.6979 23.2869 24.6212 23.4386 24.5165 23.5708C24.4117 23.7031 24.2811 23.8132 24.1323 23.8945C23.9836 23.9759 23.8197 24.0268 23.6505 24.0444C23.4814 24.0619 23.3104 24.0457 23.1477 23.9966L18.2526 22.7032C18.0919 22.6607 17.9412 22.5873 17.8092 22.4873C17.6772 22.3873 17.5665 22.2626 17.4834 22.1204C17.4002 21.9782 17.3463 21.8212 17.3247 21.6584C17.3031 21.4956 17.3142 21.3301 17.3573 21.1716Z" fill="#4267AD"/>
      </svg>        
      <div class="lg:max-w-[240px] max-w-[300px]">
        <h3 class="font-semibold text-base mb-2">Rencana masa depan</h3>
        <p class="font-medium text-xs leading-6 flex items-center justify-center text-justify">Nanti kalo udah gede mau jadi apa ya? Bisa jadi apa aja ya? Aku bisa apa? pertanyaan yang ada dipikiranmu itu, ada jawabannya di Konsul ini!</p>
      </div>
    </div>
  </div>
  <div class="px-12 py-14 bg-grey-landing flex flex-col items-center space-y-3">
    <div class="w-20 h-0.5 bg-dark-grey-landing rounded-full"></div>
    <p class=" w-[96%]  lg:w-3/5 text-dark-grey-landing text-center">Ga cuma yang ada di atas aja loh, kamu juga bisa tanya-tanya hal lain. Jadi gaperlu khawatir dan Psikolog di <span class="font-bold">DeepTalk</span> juga sudah teruji dan berpengalaman. Selesaikan <span class="font-bold">masalahmu</span>, dengan mencari jalan dan <span class="font-bold">memperbaikinya.</span></p>
  </div>
  <div class="flex flex-col items-center px-24 my-24 ">
    <div class="space-y-3 flex flex-col items-center">
      <div class="w-16 h-2 bg-yellow-landing rounded-full"></div> 
      <h1 class="text-2xl text-center">3 Langkah untuk melakukan konseling</h1>
    </div>
    <div class="flex lg:flex-row flex-col justify-evenly w-full mt-24 space-y-7 lg:space-y-0">
      <div class="shadow-card_lp items-center flex flex-col py-4 rounded-2xl w-[300px] mx-auto">
        <h3 class="text-xl text-primary-landing">Login</h3>
        <div class="max-h-[200px] min-h-[120px] my-5">
          <img class="w-24" src="{{ asset('img/login_lp.png') }}" alt="">
        </div>
        <p class="text-center  w-2/3 text-sm"><span class="font-bold">Login</span> menggunakan akun yang sudah diberikan</p>
        <span class="mt-10 text-grey-txt text-xs font-bold">STEP ONE</span>
      </div>
      <div class="shadow-card_lp items-center flex flex-col py-4 rounded-2xl w-[300px] mx-auto ">
        <h3 class="text-xl text-primary-landing">Halaman Konsul</h3>
        <div class="max-h-[200px] min-h-[120px] my-5">
          <img class="w-36" src="{{ asset('img/clickHere_lp.png') }}" alt="">
        </div>
        <p class="text-center  w-2/3 text-sm">Masuk ke halaman konseling dan klik Konsul</p>
        <span class="mt-10 text-grey-txt text-xs font-bold">STEP TWO</span>
      </div>
      <div class="shadow-card_lp items-center flex flex-col py-4 rounded-2xl w-[300px] mx-auto">
        <h3 class="text-xl text-primary-landing">Isi Form</h3>
        <div class="max-h-[200px] min-h-[120px] my-5">
          <img class="w-36" src="{{ asset('img/info_lp.png') }}" alt="">
        </div>
        <p class="text-center  w-2/3 text-sm">Isi field atau form yang ada di tampilan tambah Konsul</p>
        <span class="mt-10 text-grey-txt text-xs font-bold">STEP THREE</span>
      </div>
    </div>
  </div>
  <footer class="bg-primary-landing items-center py-10 text-white flex flex-col">
    <p>Udah siap untuk hidup lebih tenang dan bahagia?</p>
    <a class="px-8 rounded-lg py-3 bg-yellow-landing text-white mt-5 mb-28">Konsul Sekarang</a>

    <a href="">CopyrightbyDeepTalk@2023</a>
  </footer>
  <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
  <script src="{{ asset('assets/js/menu.js') }}"></script>
  <script src="{{ asset('assets/js/dropdown.js') }}"></script>
  @stack('js')
</body>

</html>