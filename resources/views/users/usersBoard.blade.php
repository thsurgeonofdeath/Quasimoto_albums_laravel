<x-dashboard-bar>
    
       
    <div class="flex flex-col mt-10">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden flex justify-center content-center">                  
                <livewire:user :users="$users"/>
            </div>
          </div>
        </div>
    </div>  

     
</x-dashboard-bar>