     <div id="sidebar" class="app-sidebar">

         <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

             <div class="menu">
                 <div class="menu-header">Navigation</div>
                 <div class="menu-item">
                     <a href="{{ url('/') }}" class="menu-link">
                         <span class="menu-icon"><i class="bi bi-house-heart"></i></span>
                         <span class="menu-text">Home</span>
                     </a>
                 </div>
                 <div class="menu-item">
                     <a href="{{ url('/1') }}" class="menu-link">
                         <span class="menu-icon"><i class="bi bi-people"></i></span>
                         <span class="menu-text">Daftar Pegawai versi 1</span>
                     </a>
                     <a href="{{ url('/2') }}" class="menu-link">
                         <span class="menu-icon"><i class="bi bi-people"></i></span>
                         <span class="menu-text">Daftar Pegawai versi 2</span>
                     </a>
                 </div>
             </div>
         </div>

     </div>


     <button class="app-sidebar-mobile-backdrop" data-toggle-target=".app"
         data-toggle-class="app-sidebar-mobile-toggled"></button>
