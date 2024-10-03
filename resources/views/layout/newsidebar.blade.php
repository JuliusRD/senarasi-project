
<style>
    ::after,
::before {
box-sizing: border-box;
margin: 0;
padding: 0;
}

a {
text-decoration: none;
}


#sidebar {
  padding-top: 8px;
  width: 80px;
  min-width: 70px;
  z-index: 1000;
  transition: all .25s ease-in-out;
  background-color: #260B6F;
  display: flex;
  flex-direction: column;
  padding-bottom: 40px;
  position: fixed; /* Mengubah dari absolute ke fixed */
  top: 0; /* Pastikan posisinya dimulai dari atas */
  bottom: 0; /* Pastikan sidebar menjangkau sampai bawah */
  height: 100%;
  overflow: auto; /* Mengizinkan scroll jika konten lebih tinggi dari sidebar */
  scrollbar-width: none;
}

#sidebar.expand {
width: 260px;
min-width: 260px;
overflow: auto;
}
/* Untuk menyembunyikan scrollbar di Chrome, Edge, Safari */
#sidebar.expand::-webkit-scrollbar {
  display: none;
}
.toggle-btn {
background-color: transparent;
cursor: pointer;
border: 0;
padding: 1rem 1.5rem;
}

.toggle-btn i {
font-size: 1.5rem;
color: #FFF;
}

.sidebar-logo {
margin: auto 0;
}

.sidebar-logo a {
color: #FFF;
font-size: 1.15rem;
font-weight: 600;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
display: none;
}

.sidebar-nav {
padding: 2rem 0;
flex: 1 1 auto;
}

a.sidebar-link {
padding: .925rem 1.625rem;
color: #FFF;
display: block;
font-size: 0.9rem;
white-space: nowrap;
border-left: 3px solid transparent;
}

.sidebar-link i {
font-size: 1.1rem;
margin-right: .75rem;
line-height: 1;
}
.sidebar-link span {
flex-grow: 1;
line-height: 1; /* Pastikan line-height tidak melebihi ukuran font */
margin-left: 12px;
}

a.sidebar-link:hover, a.sidebar-link.active {
background-color:#4a25aa;
border-left: 3px solid #3b7ddd;
}

.sidebar-item {
position: relative;
}

#sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
position: absolute;
top: 0;
left: 70px;
background-color: #260B6F;
padding: 0;
min-width: 15rem;
display: none;
}

/* #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
display: block;
width: 100%;
opacity: 1;
} */

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
border: solid;
border-width: 0 .075rem .075rem 0;
content: "";
display: inline-block;
padding: 2px;
position: absolute;
right: 1.5rem;
top: 1.4rem;
transform: rotate(-135deg);
transition: all .2s ease-out;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
transform: rotate(45deg);
transition: all .2s ease-out;
}

.dropdown-menu{
border: none;
}
.overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Warna overlay dengan transparansi */
            display: none; /* Tersembunyi di awal */
            z-index: 1;
        }

        .overlay.show {
            display: block; /* Tampilkan overlay */
        }


</style>



    <aside id="sidebar" >
        <ul class="sidebar-nav" style="padding-top: 60px">
            <li class="sidebar-item" style="list-style: none;">
                <a href="{{ route('dashboard.budget') }}" class="sidebar-link {{ request()->routeIs('dashboard-budget' ) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 18 18" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.49231 0H2.42308C2.106 0 1.83323 1.03162e-08 1.59231 0.0567692C1.21934 0.14589 0.878331 0.336526 0.607058 0.607554C0.335785 0.878583 0.144841 1.21942 0.0553846 1.59231C-5.15809e-08 1.83323 0 2.10462 0 2.42308V5.88462C0 6.20169 1.03162e-08 6.47446 0.0567692 6.71538C0.14589 7.08835 0.336526 7.42936 0.607555 7.70063C0.878583 7.97191 1.21942 8.16285 1.59231 8.25231C1.83323 8.30769 2.10462 8.30769 2.42308 8.30769H5.88462C6.20169 8.30769 6.47446 8.30769 6.71538 8.25092C7.08835 8.1618 7.42936 7.97117 7.70063 7.70014C7.97191 7.42911 8.16285 7.08827 8.25231 6.71538C8.30769 6.47446 8.30769 6.20308 8.30769 5.88462V2.42308C8.30769 2.106 8.30769 1.83323 8.25092 1.59231C8.1618 1.21934 7.97117 0.878331 7.70014 0.607058C7.42911 0.335785 7.08827 0.144841 6.71538 0.0553846C6.47446 -5.15809e-08 6.20308 0 5.88462 0H5.81538H2.49231ZM1.91492 1.404C1.97446 1.39015 2.06723 1.38462 2.49231 1.38462H5.81538C6.24185 1.38462 6.33323 1.38877 6.39277 1.404C6.51715 1.43374 6.63086 1.49736 6.72129 1.58779C6.81172 1.67822 6.87533 1.79193 6.90508 1.91631C6.91892 1.97446 6.92308 2.06585 6.92308 2.49231V5.81538C6.92308 6.24185 6.91892 6.33323 6.90369 6.39277C6.87395 6.51715 6.81033 6.63086 6.7199 6.72129C6.62947 6.81172 6.51576 6.87533 6.39139 6.90508C6.33462 6.91754 6.24323 6.92308 5.81538 6.92308H2.49231C2.06585 6.92308 1.97446 6.91892 1.91492 6.90369C1.79054 6.87395 1.67683 6.81033 1.5864 6.7199C1.49597 6.62947 1.43236 6.51576 1.40262 6.39138C1.39015 6.33462 1.38462 6.24323 1.38462 5.81538V2.49231C1.38462 2.06585 1.38877 1.97446 1.404 1.91492C1.43374 1.79054 1.49736 1.67683 1.58779 1.5864C1.67822 1.49597 1.79193 1.43236 1.91631 1.40262M12.1846 0H12.1154C11.7983 0 11.5255 1.03162e-08 11.2846 0.0567692C10.9116 0.14589 10.5706 0.336526 10.2994 0.607554C10.0281 0.878583 9.83715 1.21942 9.74769 1.59231C9.69231 1.83323 9.69231 2.10462 9.69231 2.42308V5.88462C9.69231 6.20169 9.69231 6.47446 9.74908 6.71538C9.8382 7.08835 10.0288 7.42936 10.2999 7.70063C10.5709 7.97191 10.9117 8.16285 11.2846 8.25231C11.5255 8.30769 11.7969 8.30769 12.1154 8.30769H15.5769C15.894 8.30769 16.1668 8.30769 16.4077 8.25092C16.7807 8.1618 17.1217 7.97117 17.3929 7.70014C17.6642 7.42911 17.8552 7.08827 17.9446 6.71538C18 6.47446 18 6.20308 18 5.88462V2.42308C18 2.106 18 1.83323 17.9432 1.59231C17.8541 1.21934 17.6635 0.878331 17.3924 0.607058C17.1214 0.335785 16.7806 0.144841 16.4077 0.0553846C16.1668 -5.15809e-08 15.8954 0 15.5769 0H15.5077H12.1846ZM11.6072 1.404C11.6668 1.39015 11.7595 1.38462 12.1846 1.38462H15.5077C15.9342 1.38462 16.0255 1.38877 16.0851 1.404C16.2095 1.43374 16.3232 1.49736 16.4136 1.58779C16.504 1.67822 16.5676 1.79193 16.5974 1.91631C16.6112 1.97446 16.6154 2.06585 16.6154 2.49231V5.81538C16.6154 6.24185 16.6098 6.33323 16.596 6.39277C16.5663 6.51715 16.5026 6.63086 16.4122 6.72129C16.3218 6.81172 16.2081 6.87533 16.0837 6.90508C16.0255 6.91892 15.9342 6.92308 15.5077 6.92308H12.1846C11.7582 6.92308 11.6668 6.91892 11.6072 6.90369C11.4829 6.87395 11.3691 6.81033 11.2787 6.7199C11.1883 6.62947 11.1247 6.51576 11.0949 6.39138C11.0825 6.33462 11.0769 6.24323 11.0769 5.81538V2.49231C11.0769 2.06585 11.0811 1.97446 11.0963 1.91492C11.1261 1.79054 11.1897 1.67683 11.2801 1.5864C11.3705 1.49597 11.4842 1.43236 11.6086 1.40262M2.42308 9.69231H5.88462C6.20169 9.69231 6.47446 9.69231 6.71538 9.74908C7.08835 9.8382 7.42936 10.0288 7.70063 10.2999C7.97191 10.5709 8.16285 10.9117 8.25231 11.2846C8.30769 11.5255 8.30769 11.7969 8.30769 12.1154V15.5769C8.30769 15.894 8.30769 16.1668 8.25092 16.4077C8.1618 16.7807 7.97117 17.1217 7.70014 17.3929C7.42911 17.6642 7.08827 17.8552 6.71538 17.9446C6.47446 18 6.20308 18 5.88462 18H2.42308C2.106 18 1.83323 18 1.59231 17.9432C1.21934 17.8541 0.878331 17.6635 0.607058 17.3924C0.335785 17.1214 0.144841 16.7806 0.0553846 16.4077C-5.15809e-08 16.1668 0 15.8954 0 15.5769V12.1154C0 11.7983 1.03162e-08 11.5255 0.0567692 11.2846C0.14589 10.9116 0.336526 10.5706 0.607555 10.2994C0.878583 10.0281 1.21942 9.83715 1.59231 9.74769C1.83323 9.69231 2.10462 9.69231 2.42308 9.69231ZM2.49231 11.0769C2.06585 11.0769 1.97446 11.0811 1.91492 11.0963C1.79054 11.1261 1.67683 11.1897 1.5864 11.2801C1.49597 11.3705 1.43236 11.4842 1.40262 11.6086C1.39015 11.6654 1.38462 11.7568 1.38462 12.1846V15.5077C1.38462 15.9342 1.38877 16.0255 1.404 16.0851C1.43374 16.2095 1.49736 16.3232 1.58779 16.4136C1.67822 16.504 1.79193 16.5676 1.91631 16.5974C1.97446 16.6112 2.06585 16.6154 2.49231 16.6154H5.81538C6.24185 16.6154 6.33323 16.6098 6.39277 16.596C6.51715 16.5663 6.63086 16.5026 6.72129 16.4122C6.81172 16.3218 6.87533 16.2081 6.90508 16.0837C6.91892 16.0255 6.92308 15.9342 6.92308 15.5077V12.1846C6.92308 11.7582 6.91892 11.6668 6.90369 11.6072C6.87395 11.4829 6.81033 11.3691 6.7199 11.2787C6.62947 11.1883 6.51576 11.1247 6.39139 11.0949C6.33462 11.0825 6.24323 11.0769 5.81538 11.0769H2.49231ZM12.1846 9.69231H12.1154C11.7983 9.69231 11.5255 9.69231 11.2846 9.74908C10.9116 9.8382 10.5706 10.0288 10.2994 10.2999C10.0281 10.5709 9.83715 10.9117 9.74769 11.2846C9.69231 11.5255 9.69231 11.7969 9.69231 12.1154V15.5769C9.69231 15.894 9.69231 16.1668 9.74908 16.4077C9.8382 16.7807 10.0288 17.1217 10.2999 17.3929C10.5709 17.6642 10.9117 17.8552 11.2846 17.9446C11.5255 18.0014 11.7983 18.0014 12.1154 18.0014H15.5769C15.894 18.0014 16.1668 18.0014 16.4077 17.9446C16.7804 17.8553 17.1211 17.6645 17.3921 17.3935C17.6631 17.1225 17.8539 16.7818 17.9432 16.4091C18 16.1682 18 15.8954 18 15.5783V12.1154C18 11.7983 18 11.5255 17.9432 11.2846C17.8541 10.9116 17.6635 10.5706 17.3924 10.2994C17.1214 10.0281 16.7806 9.83715 16.4077 9.74769C16.1668 9.69231 15.8954 9.69231 15.5769 9.69231H15.5077H12.1846ZM11.6072 11.0963C11.6668 11.0825 11.7595 11.0769 12.1846 11.0769H15.5077C15.9342 11.0769 16.0255 11.0811 16.0851 11.0963C16.2095 11.1261 16.3232 11.1897 16.4136 11.2801C16.504 11.3705 16.5676 11.4842 16.5974 11.6086C16.6112 11.6668 16.6154 11.7582 16.6154 12.1846V15.5077C16.6154 15.9342 16.6098 16.0255 16.596 16.0851C16.5663 16.2095 16.5026 16.3232 16.4122 16.4136C16.3218 16.504 16.2081 16.5676 16.0837 16.5974C16.0255 16.6112 15.9342 16.6154 15.5077 16.6154H12.1846C11.7582 16.6154 11.6668 16.6098 11.6072 16.596C11.4829 16.5663 11.3691 16.5026 11.2787 16.4122C11.1883 16.3218 11.1247 16.2081 11.0949 16.0837C11.0825 16.0269 11.0769 15.9355 11.0769 15.5077V12.1846C11.0769 11.7582 11.0811 11.6668 11.0963 11.6072C11.1261 11.4829 11.1897 11.3691 11.2801 11.2787C11.3705 11.1883 11.4842 11.1247 11.6086 11.0949" fill="white"/>
                      </svg>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item" style="list-style: none;">
                <a href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/budget-*', ) ? 'active' : ''}} " data-bs-toggle="collapse"
                    data-bs-target="#budget" aria-expanded="false" aria-controls="budget">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 18 18" fill="none">
                        <g clip-path="url(#clip0_1168_1371)">
                          <path d="M8.39995 5.04004C7.65115 5.26198 7.19995 5.88531 7.19995 6.4731C7.19995 7.06089 7.65115 7.68423 8.39995 7.9053V5.04004ZM9.59995 9.37564V12.24C10.3488 12.019 10.8 11.3956 10.8 10.8078C10.8 10.2201 10.3488 9.59671 9.59995 9.37564Z" fill="white"/>
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M18 8.64C18 13.4119 13.9707 17.28 9 17.28C4.0293 17.28 0 13.4119 0 8.64C0 3.86813 4.0293 0 9 0C13.9707 0 18 3.86813 18 8.64ZM9 2.808C9.17902 2.808 9.35071 2.87627 9.4773 2.99779C9.60388 3.11932 9.675 3.28414 9.675 3.456V3.72989C11.142 3.98218 12.375 5.04058 12.375 6.48C12.375 6.65186 12.3039 6.81668 12.1773 6.9382C12.0507 7.05973 11.879 7.128 11.7 7.128C11.521 7.128 11.3493 7.05973 11.2227 6.9382C11.0961 6.81668 11.025 6.65186 11.025 6.48C11.025 5.89421 10.5174 5.27299 9.675 5.05181V8.04989C11.142 8.30218 12.375 9.36058 12.375 10.8C12.375 12.2394 11.142 13.2978 9.675 13.5501V13.824C9.675 13.9959 9.60388 14.1607 9.4773 14.2822C9.35071 14.4037 9.17902 14.472 9 14.472C8.82098 14.472 8.64929 14.4037 8.5227 14.2822C8.39612 14.1607 8.325 13.9959 8.325 13.824V13.5501C6.858 13.2978 5.625 12.2394 5.625 10.8C5.625 10.6281 5.69612 10.4633 5.8227 10.3418C5.94929 10.2203 6.12098 10.152 6.3 10.152C6.47902 10.152 6.65071 10.2203 6.7773 10.3418C6.90388 10.4633 6.975 10.6281 6.975 10.8C6.975 11.3858 7.4826 12.007 8.325 12.2273V9.23011C6.858 8.97782 5.625 7.91942 5.625 6.48C5.625 5.04058 6.858 3.98218 8.325 3.72989V3.456C8.325 3.28414 8.39612 3.11932 8.5227 2.99779C8.64929 2.87627 8.82098 2.808 9 2.808Z" fill="white"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1168_1371">
                            <rect width="18" height="17.28" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                    <span class="align-middle">Budget</span>
                </a>
                <ul id="budget" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('budget.index') }}" class="sidebar-link">(ON PROGRESS)Budget Department</a>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('budget.index') }}" class="sidebar-link">Budget Program</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item" style="list-style: none;">
                <a  href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/request-budget-*', ) ? 'active' : ''}} " data-bs-toggle="collapse"
                    data-bs-target="#request" aria-expanded="false" aria-controls="request">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 17 19" fill="none">
                        <path d="M1 10.4214H3.2689C3.54742 10.4214 3.82216 10.4839 4.07131 10.6052L6.0058 11.5412C6.25495 11.6615 6.52968 11.724 6.80915 11.724H7.79629C8.75122 11.724 9.52615 12.4733 9.52615 13.398C9.52615 13.4359 9.50057 13.4681 9.46363 13.4785L7.05641 14.1445C6.62447 14.2638 6.16388 14.222 5.76043 14.027L3.69237 13.0266" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.52615 12.7896L13.8773 11.4528C14.2561 11.3366 14.662 11.343 15.0369 11.4711C15.4119 11.5992 15.7368 11.8425 15.9653 12.1662C16.3149 12.6493 16.1728 13.3428 15.6631 13.6365L8.54375 17.7451C8.32114 17.8739 8.07463 17.9561 7.81925 17.9865C7.56387 18.017 7.30497 17.9951 7.0583 17.9223L1 16.1242" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.27344 2.12207C8.95816 2.21552 8.76819 2.47797 8.76819 2.72545C8.76819 2.97294 8.95816 3.23539 9.27344 3.32847V2.12207ZM9.7787 3.94755V5.15359C10.094 5.06051 10.2839 4.79806 10.2839 4.55057C10.2839 4.30309 10.094 4.04063 9.7787 3.94755Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.3155 3.63782C13.3155 5.64699 11.619 7.27565 9.5261 7.27565C7.43321 7.27565 5.73669 5.64699 5.73669 3.63782C5.73669 1.62865 7.43321 0 9.5261 0C11.619 0 13.3155 1.62865 13.3155 3.63782ZM9.5261 1.18229C9.60147 1.18229 9.67376 1.21104 9.72706 1.2622C9.78036 1.31337 9.8103 1.38277 9.8103 1.45513V1.57045C10.428 1.67667 10.9471 2.12231 10.9471 2.72837C10.9471 2.80073 10.9172 2.87013 10.8639 2.92129C10.8106 2.97246 10.7383 3.00121 10.6629 3.00121C10.5875 3.00121 10.5153 2.97246 10.462 2.92129C10.4087 2.87013 10.3787 2.80073 10.3787 2.72837C10.3787 2.48172 10.165 2.22016 9.8103 2.12704V3.38936C10.428 3.49559 10.9471 3.94122 10.9471 4.54728C10.9471 5.15334 10.428 5.59898 9.8103 5.7052V5.82052C9.8103 5.89288 9.78036 5.96228 9.72706 6.01344C9.67376 6.06461 9.60147 6.09336 9.5261 6.09336C9.45072 6.09336 9.37843 6.06461 9.32513 6.01344C9.27183 5.96228 9.24189 5.89288 9.24189 5.82052V5.7052C8.62422 5.59898 8.10507 5.15334 8.10507 4.54728C8.10507 4.47492 8.13501 4.40552 8.18831 4.35436C8.24161 4.30319 8.3139 4.27444 8.38927 4.27444C8.46465 4.27444 8.53694 4.30319 8.59024 4.35436C8.64354 4.40552 8.67348 4.47492 8.67348 4.54728C8.67348 4.79392 8.8872 5.05548 9.24189 5.14825V3.88629C8.62422 3.78006 8.10507 3.33443 8.10507 2.72837C8.10507 2.12231 8.62422 1.67667 9.24189 1.57045V1.45513C9.24189 1.38277 9.27183 1.31337 9.32513 1.2622C9.37843 1.21104 9.45072 1.18229 9.5261 1.18229Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Request Budget</span>
                </a>
                <ul id="request" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#request-two" aria-expanded="false" aria-controls="request-two">
                            (ON PROGRESS)Department
                        </a>
                        <ul id="request-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}"  class="sidebar-link ps-5">Budget Payment</a>
                            </li>
                            <li class="sidebar-item"style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}" class="sidebar-link ps-5">Budget Purchase</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}" class="sidebar-link ps-5">Budget Advance</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#request-three" aria-expanded="false" aria-controls="request-three">
                            Program
                        </a>
                        <ul id="request-three" class="sidebar-dropdown list-unstyled collapse ">
                             <li class="sidebar-item">
                                <a href="{{ route('request-budget.index') }}"  class="sidebar-link ps-5">Budget Program</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}" class="sidebar-link ps-5">Budget Payment</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}" class="sidebar-link ps-5">Budget Purchase</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="{{ route('request-budget.index') }}" class="sidebar-link ps-5">Budget Advance</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @if (Auth::User()->role == 'Manager' or Auth::User()->role == 'Admin')
            <li class="sidebar-item" style="list-style: none;">
                <a  href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/approval-budget-*', ) ? 'active' : ''}} " data-bs-toggle="collapse"
                    data-bs-target="#approval" aria-expanded="false" aria-controls="approval">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 19 18" fill="none">
                        <path d="M18.3311 9.53612L17.2701 7.86263L17.8994 5.98449C17.9409 5.86027 17.9382 5.72553 17.8918 5.60307C17.8453 5.48062 17.758 5.378 17.6445 5.31258L15.9277 4.32287L15.612 2.36721C15.5908 2.2379 15.5256 2.11987 15.4275 2.03298C15.3294 1.94609 15.2044 1.89566 15.0735 1.89016L13.0934 1.81263L11.9053 0.227148C11.8268 0.122227 11.7144 0.04776 11.5872 0.0164308C11.4599 -0.0148984 11.3258 -0.0011519 11.2076 0.0553288L9.41882 0.906044L7.62939 0.0546304C7.51098 -0.00124154 7.37694 -0.0145898 7.24984 0.0168348C7.12274 0.0482595 7.01036 0.122536 6.93163 0.227148L5.74357 1.81263L3.76346 1.89016C3.63264 1.89539 3.50765 1.94567 3.40964 2.03247C3.31164 2.11928 3.24664 2.23728 3.22565 2.36651L2.90995 4.32217L1.19315 5.31188C1.07956 5.37719 0.992058 5.47977 0.945467 5.60223C0.898876 5.72469 0.896068 5.8595 0.937518 5.98379L1.56682 7.86193L0.506573 9.53612C0.436633 9.64694 0.407121 9.77851 0.42303 9.90859C0.438939 10.0387 0.499293 10.1592 0.59388 10.2499L2.02361 11.621L1.86297 13.5948C1.85228 13.7254 1.88704 13.8557 1.96137 13.9637C2.0357 14.0716 2.14503 14.1505 2.27086 14.1871L4.17415 14.7354L4.94873 16.5591C4.99958 16.6799 5.09084 16.7794 5.2069 16.8404C5.32297 16.9014 5.45662 16.9202 5.58502 16.8936L7.52672 16.4955L9.05912 17.7506C9.16319 17.8351 9.29101 17.8791 9.41882 17.8791C9.54664 17.8791 9.67376 17.8351 9.77853 17.7506L11.3109 16.4955L13.2526 16.8936C13.5159 16.9495 13.7835 16.8077 13.8889 16.5591L14.6635 14.7354L16.5668 14.1871C16.6927 14.1506 16.8021 14.0717 16.8764 13.9638C16.9508 13.8558 16.9855 13.7255 16.9747 13.5948L16.814 11.621L18.2438 10.2499C18.3384 10.1592 18.3987 10.0387 18.4146 9.90859C18.4305 9.77851 18.401 9.64694 18.3311 9.53612ZM13.5236 6.80447L9.54873 12.7595C9.39857 12.9816 9.16598 13.1304 8.9348 13.1304C8.70431 13.1304 8.44658 13.0011 8.28244 12.8363L5.36431 9.87138C5.26866 9.77328 5.21512 9.6417 5.21512 9.50469C5.21512 9.36768 5.26866 9.23609 5.36431 9.138L6.08441 8.40463C6.1316 8.35718 6.1877 8.31952 6.24949 8.29382C6.31128 8.26813 6.37754 8.2549 6.44446 8.2549C6.51138 8.2549 6.57764 8.26813 6.63944 8.29382C6.70123 8.31952 6.75733 8.35718 6.80452 8.40463L8.70361 10.3338L11.8355 5.64155C11.8726 5.5856 11.9205 5.53759 11.9764 5.50035C12.0322 5.4631 12.095 5.43736 12.1609 5.42461C12.2268 5.41187 12.2946 5.41238 12.3603 5.42613C12.4261 5.43987 12.4884 5.46656 12.5437 5.50465L13.3881 6.08507C13.6207 6.24571 13.6808 6.56909 13.5236 6.80447Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Approval</span>
                </a>
                <ul id="approval" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#approval-two" aria-expanded="false" aria-controls="approval-two">
                            (ON PROGRESS)Department
                        </a>
                        <ul id="approval-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail"  class="sidebar-link ps-5">Payment Approval</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail"  class="sidebar-link ps-5">Purchase Approval</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail"  class="sidebar-link ps-5">Advance Approval</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#approval-three" aria-expanded="false" aria-controls="approval-three">
                            Program
                        </a>
                        <ul id="approval-three" class="sidebar-dropdown list-unstyled collapse ">
                             <li class="sidebar-item">
                                <a href="/approval" class="sidebar-link ps-5">Program Approval</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail" class="sidebar-link ps-5">Payment Approval</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail" class="sidebar-link ps-5">Purchase Approval</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="/approval-detail" class="sidebar-link ps-5">Advance Approval</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif


            <li class="sidebar-item" style="list-style: none;">
                <a  href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/report-budget-*', ) ? 'active' : ''}} " data-bs-toggle="collapse"
                    data-bs-target="#report" aria-expanded="false" aria-controls="report">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="22" viewBox="0 0 16 18" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.25 5.625C1.65326 5.625 1.08097 5.86205 0.65901 6.28401C0.237053 6.70597 0 7.27826 0 7.875V15.1875C0 15.9334 0.296316 16.6488 0.823762 17.1762C1.35121 17.7037 2.06658 18 2.8125 18H12.9375C13.6834 18 14.3988 17.7037 14.9262 17.1762C15.4537 16.6488 15.75 15.9334 15.75 15.1875V13.5C15.75 12.9033 15.5129 12.331 15.091 11.909C14.669 11.4871 14.0967 11.25 13.5 11.25H11.3861C11.0878 11.2499 10.8017 11.1314 10.5907 10.9204L5.95463 6.28425C5.53277 5.86226 4.96056 5.62513 4.36388 5.625H2.25Z" fill="white"/>
                        <path d="M10.125 0C10.7217 0 11.294 0.237053 11.716 0.65901C12.1379 1.08097 12.375 1.65326 12.375 2.25V10.125H11.3861L6.75 5.48888C6.11721 4.8559 5.25891 4.50019 4.36388 4.5H2.25C1.85625 4.5 1.47712 4.5675 1.125 4.69125V2.25C1.125 1.65326 1.36205 1.08097 1.78401 0.65901C2.20597 0.237053 2.77826 0 3.375 0H10.125Z" fill="white"/>
                        <path d="M13.5 10.125C13.8937 10.125 14.2729 10.1925 14.625 10.3163V4.5C14.625 4.10505 14.521 3.71706 14.3235 3.37503C14.1261 3.033 13.842 2.74897 13.5 2.5515V10.125Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Report Budget</span>
                </a>
                <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#report-two" aria-expanded="false" aria-controls="report-two">
                            (ON PROGRESS)Department
                        </a>
                        <ul id="report-two" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item" style="list-style: none;">
                                <a  href="" class="sidebar-link ps-5">Payment Report</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="" class="sidebar-link ps-5">Purchase Report</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="" class="sidebar-link ps-5">Advance Report</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                            data-bs-target="#report-three" aria-expanded="false" aria-controls="report-three">
                            Program
                        </a>
                        <ul id="report-three" class="sidebar-dropdown list-unstyled collapse ">
                             <li class="sidebar-item">
                                <a  href="/report" class="sidebar-link ps-5">Program Report</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="" class="sidebar-link ps-5">Payment Report</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="" class="sidebar-link ps-5">Purchase Report</a>
                            </li>
                            <li class="sidebar-item" style="list-style: none;">
                                <a href="" class="sidebar-link ps-5">Advance Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item" style="list-style: none;">
                <a href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/people*', ) ? 'active' : ''}}" data-bs-toggle="collapse"
                    data-bs-target="#people" aria-expanded="false" aria-controls="people">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 19 15" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.7618 10.0879C15.7618 10.4202 16.0229 10.6813 16.3552 10.6813C17.3403 10.6813 18.1354 9.88614 18.1354 8.90109C18.1354 6.97845 16.8181 5.36439 15.0497 4.88966C15.5007 4.36747 15.7618 3.70285 15.7618 2.96703C15.7618 2.18012 15.4492 1.42545 14.8928 0.869023C14.3364 0.312597 13.5817 0 12.7948 0C12.4625 0 12.2014 0.261099 12.2014 0.593406C12.2014 0.925713 12.4625 1.18681 12.7948 1.18681C13.7798 1.18681 14.575 1.98198 14.575 2.96703C14.575 3.95208 13.7798 4.74725 12.7948 4.74725C12.4625 4.74725 12.2014 5.00834 12.2014 5.34065C12.2014 5.67296 12.4625 5.93406 12.7948 5.93406H13.9816C14.7685 5.93406 15.5232 6.24665 16.0796 6.80308C16.636 7.35951 16.9486 8.11418 16.9486 8.90109C16.9486 9.23339 16.6875 9.49449 16.3552 9.49449C16.0229 9.49449 15.7618 9.75559 15.7618 10.0879ZM0.333252 8.90109C0.333252 9.88614 1.12842 10.6813 2.11347 10.6813C2.44578 10.6813 2.70688 10.4202 2.70688 10.0879C2.70688 9.75559 2.44578 9.49449 2.11347 9.49449C1.78116 9.49449 1.52006 9.23339 1.52006 8.90109C1.52006 8.11418 1.83266 7.35951 2.38909 6.80308C2.94551 6.24665 3.70019 5.93406 4.48709 5.93406H5.6739C6.00621 5.93406 6.26731 5.67296 6.26731 5.34065C6.26731 5.00834 6.00621 4.74725 5.6739 4.74725C4.68885 4.74725 3.89369 3.95208 3.89369 2.96703C3.89369 1.98198 4.68885 1.18681 5.6739 1.18681C6.00621 1.18681 6.26731 0.925713 6.26731 0.593406C6.26731 0.261099 6.00621 0 5.6739 0C4.887 0 4.13232 0.312597 3.5759 0.869023C3.01947 1.42545 2.70688 2.18012 2.70688 2.96703C2.70688 3.70285 2.97984 4.36747 3.41896 4.88966C1.63874 5.36439 0.333252 6.97845 0.333252 8.90109Z" fill="white"/>
                        <path d="M9.43212 5.93406C8.64521 5.93406 7.89054 5.62146 7.33411 5.06504C6.77768 4.50861 6.46509 3.75393 6.46509 2.96703C6.46509 2.18012 6.77768 1.42545 7.33411 0.869023C7.89054 0.312597 8.64521 0 9.43212 0C10.219 0 10.9737 0.312597 11.5301 0.869023C12.0865 1.42545 12.3991 2.18012 12.3991 2.96703C12.3991 3.75393 12.0865 4.50861 11.5301 5.06504C10.9737 5.62146 10.219 5.93406 9.43212 5.93406ZM9.43212 1.18681C8.44706 1.18681 7.6519 1.98198 7.6519 2.96703C7.6519 3.95208 8.44706 4.74725 9.43212 4.74725C10.4172 4.74725 11.2123 3.95208 11.2123 2.96703C11.2123 1.98198 10.4172 1.18681 9.43212 1.18681Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9926 14.2417H5.87178C4.88673 14.2417 4.09156 13.4466 4.09156 12.4615V11.2747C4.09156 8.98416 5.95486 7.12087 8.2454 7.12087H10.619C12.9096 7.12087 14.7729 8.98416 14.7729 11.2747V12.4615C14.7729 13.4466 13.9777 14.2417 12.9926 14.2417ZM8.2454 8.30768C7.4585 8.30768 6.70382 8.62028 6.1474 9.1767C5.59097 9.73313 5.27837 10.4878 5.27837 11.2747V12.4615C5.27837 12.7938 5.53947 13.0549 5.87178 13.0549H12.9926C13.325 13.0549 13.5861 12.7938 13.5861 12.4615V11.2747C13.5861 10.4878 13.2735 9.73313 12.717 9.1767C12.1606 8.62028 11.4059 8.30768 10.619 8.30768H8.2454Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Narasi People</span>
                </a>
                <ul id="people" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('department.index') }}" class="sidebar-link">Department</a>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('employee.index') }}" class="sidebar-link">Employee</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item" style="list-style: none;">
                <a href="#" class="sidebar-link collapsed has-dropdown {{ Request::is('budgeting-system/vendor*', ) ? 'active' : ''}}" data-bs-toggle="collapse"
                    data-bs-target="#vendor" aria-expanded="false" aria-controls="vendor">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 19 18" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.12639 0.0485337C9.20109 0.0165119 9.28152 0 9.36279 0C9.44407 0 9.52449 0.0165119 9.59919 0.0485337L17.7628 3.54773L9.36279 7.14773L0.962793 3.54773L9.12639 0.0485337Z" fill="white"/>
                        <path d="M0.362793 4.59653V13.8005C0.362793 14.0405 0.506793 14.2565 0.726393 14.3525L8.76279 17.7965V8.19653L0.362793 4.59653Z" fill="white"/>
                        <path d="M9.96279 8.19653L18.3628 4.59653V13.8005C18.3629 13.918 18.3285 14.033 18.2639 14.1311C18.1992 14.2292 18.1072 14.3062 17.9992 14.3525L9.96279 17.7965V8.19653Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Vendor</span>
                </a>
                <ul id="vendor" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('vendor.index') }}" class="sidebar-link">Name Vendor</a>
                    </li>
                    <li class="sidebar-item" style="list-style: none;">
                        <a href="{{ route('vendor.index') }}" class="sidebar-link">Item Vendor</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item" style="list-style: none;">
                <a href="/category"class="sidebar-link  {{ Request::is('budgeting-system/category*', ) ? 'active' : ''}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 18 18" fill="none">
                        <path d="M4.17562 6.18087L7.69069 0.448239C7.78505 0.290965 7.903 0.176784 8.04455 0.105696C8.1861 0.0346085 8.33551 -0.000620817 8.49278 8.27757e-06C8.65006 0.000637373 8.79947 0.0361814 8.94101 0.10664C9.08256 0.177099 9.20051 0.290965 9.29488 0.448239L12.8099 6.18087C12.9043 6.33814 12.9515 6.50328 12.9515 6.67628C12.9515 6.84928 12.9122 7.00655 12.8335 7.1481C12.7549 7.28965 12.6448 7.40383 12.5033 7.49064C12.3617 7.57746 12.1966 7.62055 12.0078 7.61992H4.97771C4.78898 7.61992 4.62385 7.57683 4.4823 7.49064C4.34075 7.40446 4.23066 7.29028 4.15203 7.1481C4.07339 7.00592 4.03407 6.84865 4.03407 6.67628C4.03407 6.50391 4.08125 6.33877 4.17562 6.18087ZM13.6828 18C12.5033 18 11.5008 17.5873 10.6754 16.7619C9.85005 15.9366 9.43705 14.9338 9.43642 13.7536C9.43579 12.5734 9.8488 11.571 10.6754 10.7462C11.5021 9.92146 12.5045 9.50846 13.6828 9.50721C14.8611 9.50595 15.8639 9.91895 16.6911 10.7462C17.5184 11.5735 17.9311 12.5759 17.9292 13.7536C17.9273 14.9313 17.5146 15.934 16.6911 16.7619C15.8677 17.5898 14.8649 18.0025 13.6828 18ZM0 16.5845V10.9227C0 10.6553 0.0905898 10.4313 0.271769 10.2508C0.452948 10.0702 0.676906 9.97966 0.943642 9.97903H6.6055C6.87286 9.97903 7.09713 10.0696 7.27831 10.2508C7.45949 10.432 7.54977 10.6559 7.54914 10.9227V16.5845C7.54914 16.8519 7.45855 17.0762 7.27737 17.2573C7.09619 17.4385 6.87223 17.5288 6.6055 17.5282H0.943642C0.676277 17.5282 0.452319 17.4376 0.271769 17.2564C0.0912189 17.0752 0.000629095 16.8513 0 16.5845ZM13.6828 16.1127C14.3434 16.1127 14.9017 15.8847 15.3578 15.4286C15.8139 14.9725 16.0419 14.4141 16.0419 13.7536C16.0419 13.093 15.8139 12.5347 15.3578 12.0786C14.9017 11.6225 14.3434 11.3945 13.6828 11.3945C13.0223 11.3945 12.4639 11.6225 12.0078 12.0786C11.5518 12.5347 11.3237 13.093 11.3237 13.7536C11.3237 14.4141 11.5518 14.9725 12.0078 15.4286C12.4639 15.8847 13.0223 16.1127 13.6828 16.1127ZM1.88728 15.6409H5.66185V11.8663H1.88728V15.6409ZM6.65268 5.73264H10.3329L8.49278 2.76016L6.65268 5.73264Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Category</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-popup"></i>
                    <span>Notification</span>
                </a>
            </li> --}}

        </ul>

{{--
            <div class="sidebar-footer" style="border-top: 3px solid #3b7ddd; ">
                <a href="{{ route('setting') }}" class="sidebar-link" style="padding-top: 12px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 18 18" fill="none">
                        <path d="M16.2369 9.59392C16.0926 9.4297 16.0131 9.21859 16.0131 9C16.0131 8.78141 16.0926 8.5703 16.2369 8.40608L17.3887 7.11026C17.5157 6.96868 17.5945 6.79053 17.6139 6.60138C17.6333 6.41223 17.5923 6.2218 17.4967 6.0574L15.697 2.94382C15.6024 2.77961 15.4584 2.64945 15.2855 2.57189C15.1126 2.49433 14.9196 2.47333 14.7341 2.51188L13.0423 2.85384C12.8271 2.89832 12.603 2.86246 12.4123 2.75305C12.2217 2.64363 12.0777 2.46822 12.0075 2.25992L11.4585 0.613141C11.3982 0.434406 11.2832 0.279164 11.1298 0.169359C10.9764 0.0595529 10.7923 0.000736816 10.6037 0.0012238H7.00415C6.80792 -0.00901865 6.61373 0.0452515 6.45124 0.155745C6.28875 0.266239 6.16689 0.426883 6.10428 0.613141L5.60034 2.25992C5.53016 2.46822 5.38615 2.64363 5.1955 2.75305C5.00485 2.86246 4.78075 2.89832 4.56549 2.85384L2.82872 2.51188C2.65284 2.48703 2.47354 2.51478 2.3134 2.59165C2.15327 2.66851 2.01946 2.79105 1.92884 2.94382L0.129088 6.0574C0.0311457 6.21996 -0.0128925 6.40933 0.00326975 6.59843C0.019432 6.78753 0.094967 6.96667 0.219076 7.11026L1.36192 8.40608C1.50619 8.5703 1.58575 8.78141 1.58575 9C1.58575 9.21859 1.50619 9.4297 1.36192 9.59392L0.219076 10.8897C0.094967 11.0333 0.019432 11.2125 0.00326975 11.4016C-0.0128925 11.5907 0.0311457 11.78 0.129088 11.9426L1.92884 15.0562C2.02342 15.2204 2.16742 15.3505 2.34031 15.4281C2.51321 15.5057 2.70618 15.5267 2.89171 15.4881L4.58348 15.1462C4.79875 15.1017 5.02285 15.1375 5.2135 15.2469C5.40415 15.3564 5.54815 15.5318 5.61834 15.7401L6.16727 17.3869C6.22988 17.5731 6.35174 17.7338 6.51423 17.8443C6.67672 17.9547 6.87091 18.009 7.06715 17.9988H10.6667C10.8553 17.9993 11.0393 17.9404 11.1928 17.8306C11.3462 17.7208 11.4612 17.5656 11.5215 17.3869L12.0705 15.7401C12.1407 15.5318 12.2847 15.3564 12.4753 15.2469C12.666 15.1375 12.8901 15.1017 13.1053 15.1462L14.7971 15.4881C14.9826 15.5267 15.1756 15.5057 15.3485 15.4281C15.5214 15.3505 15.6654 15.2204 15.76 15.0562L17.5597 11.9426C17.6553 11.7782 17.6963 11.5878 17.6769 11.3986C17.6575 11.2095 17.5787 11.0313 17.4517 10.8897L16.2369 9.59392ZM14.8961 10.7998L15.616 11.6096L14.4641 13.6074L13.4023 13.3914C12.7542 13.2589 12.08 13.369 11.5077 13.7008C10.9354 14.0325 10.5048 14.5629 10.2977 15.1912L9.95575 16.199H7.65207L7.32811 15.1732C7.12101 14.5449 6.69044 14.0146 6.11814 13.6828C5.54584 13.351 4.87164 13.2409 4.22353 13.3734L3.16168 13.5894L1.99184 11.6006L2.71174 10.7908C3.15444 10.2958 3.39918 9.65505 3.39918 8.991C3.39918 8.32695 3.15444 7.6862 2.71174 7.19125L1.99184 6.38136L3.14368 4.40163L4.20553 4.6176C4.85365 4.75008 5.52784 4.63999 6.10014 4.30822C6.67244 3.97645 7.10301 3.4461 7.31011 2.81784L7.65207 1.80098H9.95575L10.2977 2.82684C10.5048 3.4551 10.9354 3.98545 11.5077 4.31722C12.08 4.64898 12.7542 4.75908 13.4023 4.62659L14.4641 4.41062L15.616 6.40835L14.8961 7.21824C14.4584 7.71206 14.2166 8.3491 14.2166 9.009C14.2166 9.6689 14.4584 10.3059 14.8961 10.7998ZM8.80391 5.40049C8.09199 5.40049 7.39606 5.6116 6.80413 6.00712C6.21219 6.40264 5.75083 6.9648 5.47839 7.62253C5.20596 8.28025 5.13467 9.00399 5.27356 9.70223C5.41245 10.4005 5.75527 11.0418 6.25867 11.5452C6.76207 12.0486 7.40344 12.3915 8.10168 12.5303C8.79992 12.6692 9.52366 12.598 10.1814 12.3255C10.8391 12.0531 11.4013 11.5917 11.7968 10.9998C12.1923 10.4078 12.4034 9.71192 12.4034 9C12.4034 8.04535 12.0242 7.1298 11.3491 6.45476C10.6741 5.77972 9.75856 5.40049 8.80391 5.40049ZM8.80391 10.7998C8.44795 10.7998 8.09999 10.6942 7.80402 10.4964C7.50805 10.2987 7.27737 10.0176 7.14115 9.68874C7.00493 9.35987 6.96929 8.998 7.03874 8.64889C7.10818 8.29977 7.27959 7.97908 7.53129 7.72738C7.78299 7.47568 8.10368 7.30427 8.45279 7.23483C8.80191 7.16538 9.16378 7.20102 9.49265 7.33724C9.82151 7.47346 10.1026 7.70414 10.3004 8.00011C10.4981 8.29608 10.6037 8.64404 10.6037 9C10.6037 9.47732 10.414 9.9351 10.0765 10.2726C9.73901 10.6101 9.28123 10.7998 8.80391 10.7998Z" fill="white"/>
                      </svg>
                    <span class="align-middle">Setting</span>
                </a>
                <a href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 19 20" fill="none">
                        <path d="M6.5 3V2C6.5 1.44772 6.9477 1 7.5 1H16.5C17.0523 1 17.5 1.44772 17.5 2V18C17.5 18.5523 17.0523 19 16.5 19H7.5C6.9477 19 6.5 18.5523 6.5 18V17" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12.5 10H1.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M5 6.5L1.5 10L5 13.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                      </svg>
                    <span class="align-middle">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div> --}}


    </aside>

    <div class="overlay" id="overlay"></div>
    <script>
     const hamBurger = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");
const overlay = document.querySelector("#overlay");

// Fungsi untuk menambahkan event listener hover pada desktop
function addHoverListeners() {
    hamBurger.addEventListener("mouseover", handleMouseOver);
    hamBurger.addEventListener("mouseleave", handleMouseLeave);
    sidebar.addEventListener("mouseover", handleMouseOver);
    sidebar.addEventListener("mouseleave", handleMouseLeave);
}

// Fungsi untuk menghapus event listener hover pada mobile
function removeHoverListeners() {
    hamBurger.removeEventListener("mouseover", handleMouseOver);
    hamBurger.removeEventListener("mouseleave", handleMouseLeave);
    sidebar.removeEventListener("mouseover", handleMouseOver);
    sidebar.removeEventListener("mouseleave", handleMouseLeave);
}

// Fungsi hover (mouseover dan mouseleave)
function handleMouseOver() {
    sidebar.classList.add("expand");
    overlay.classList.add("show");
}

function handleMouseLeave() {
    sidebar.classList.remove("expand");
    overlay.classList.remove("show");
}

// Event listener untuk toggle button
hamBurger.addEventListener("click", function () {
    sidebar.classList.toggle("expand");
    overlay.classList.toggle("show");
});

// Menyembunyikan sidebar ketika overlay diklik
overlay.addEventListener("click", function () {
    sidebar.classList.remove("expand");
    overlay.classList.remove("show");
});

// Memastikan hover hanya berfungsi di desktop
function handleResize() {
    if (window.innerWidth > 768) {
        addHoverListeners(); // Aktifkan hover di desktop
    } else {
        removeHoverListeners(); // Nonaktifkan hover di mobile
    }
}

// Tambahkan event listener untuk mendeteksi perubahan ukuran layar
window.addEventListener("resize", handleResize);

// Jalankan fungsi ini pada awal halaman
handleResize();

// Optional: Tooltip functionality
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    </script>
