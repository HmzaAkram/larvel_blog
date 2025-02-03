<div>
   <div class="mb-3">
      @if (session('info'))
         <div class="alert alert-info">
            {{ session('info') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
      @endif

      @if (session('fail'))
         <div class="alert alert-danger"> <!-- Fixed "alert-dangar" typo -->
            {{ session('fail') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span> <!-- Fixed "6times;" -->
            </button>
         </div>
      @endif

      @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
            <button class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
      @endif
   </div>
</div>
