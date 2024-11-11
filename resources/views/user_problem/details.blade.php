<x-app-layout>
    <x-slot name="header">
        <div class="w-full rounded-lg shadow-lg overflow-hidden p-4" style="background: linear-gradient(12deg, #330000 0%, #00086df2 100%);">
            <div class="flex items-center justify-center p-8">
                {{-- <div class="relative flex justify-center">
                    <dotlottie-player src="https://lottie.host/1b4c86fb-8a42-45cf-882f-9eba3545920a/1nkzV3BqTx.json" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></dotlottie-player>
                </div> --}}
                
              <div class="text-center text-white">
                <h1 class="main-title">
                    {{ $user_problem->category?->name }}
                </h1>
                <p class="mt-1 text-xl">
                    {{ $user_problem->problem?->title }}
                </p>
                <p class="mt-1 text-sm opacity-80">
                    {{ $user_problem->details }}
                </p>
              </div>
            </div>
          </div>
    </x-slot>
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8" id="main-section">
        <div class="space-y-6">
            <div class="custom-card rounded-lg">
                <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Health Issue Details</label>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->category?->name }}

                            </th>

                            <th scope="col" class="px-6 py-3">Health Issue</th>

                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->appointments_count }}

                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">Problem</th>
                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->problem?->title }}

                            </th>
                            <th scope="col" class="px-6 py-3">Health Issue</th>

                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->foods_count }}

                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-3">Health Issue</th>
                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->problem?->details ?? $user_problem->details}}

                            </th>
                            <th scope="col" class="px-6 py-3">Health Issue</th>

                            <th scope="row" class="px-6 py-4 font-medium dark:text-white">
                                
                                {{ $user_problem->medicines_count }}

                            </th>
                        </tr>
                            
                    </tbody>
                </table>

            </div>

            <div class="md:flex">
                <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
                    <li>
                        <button @click="tabChange(1)" :class="tabSection == 1 ? 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg active w-full dark:bg-blue-600 ' : 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white'">
                            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                            Appointments
                        </button>
                    </li>

                    
                    <li>
                        <button @click="tabChange(2)" :class="tabSection == 2 ? 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg active w-full dark:bg-blue-600 ' : 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white'">
                            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                            Foods
                        </button>
                    </li>

                    
                    <li>
                        <button @click="tabChange(3)" :class="tabSection == 3 ? 'inline-flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg active w-full dark:bg-blue-600 ' : 'inline-flex items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white'">
                            <svg class="w-4 h-4 me-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                            Medecines
                        </button>
                    </li>
                </ul>

                <div v-if="tabSection==1" class="relative custom-card overflow-x-auto rounded-lg w-full">
                    <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Your Appointment List</label>
    
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700" v-for="(data, i) in appointmentList" :key="i">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.appointment_date ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.statusLabel ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a :href="'user-problem/'+ data.id"
                                        class="text-white bg-gray-300 hover:bg-gray-700 focus:outline-none
                                        focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                        px-5 py-2 me-2 mb-2 dark:bg-gray-500 dark:hover:bg-gray-600 
                                        dark:focus:ring-gray-500 dark:border-gray-600">
                                        View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <button
                            href="#"
                            class="prev"
                            :class="{ disabled: appointmentPagination.page === 1 }"
                            @click="goToAppointmentPage(appointmentPagination.page - 1)"
                            aria-label="Previous"
                            >
                            &laquo; Previous
                        </button>

                        <button
                            href="#"
                            class="next"
                            :class="{ disabled: appointmentPagination.page === appointmentPagination.totalPages }"
                            @click="goToAppointmentPage(appointmentPagination.page + 1)"
                            aria-label="Next"
                            >
                            Next &raquo;
                        </button>
                    </div>
                </div>

                <div v-if="tabSection==2" class="relative custom-card overflow-x-auto rounded-lg w-full">
                    <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Your Food List</label>
    
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Quantitty</th>
                                <th scope="col" class="px-6 py-3">Unit</th>
                                <th scope="col" class="px-6 py-3">Calories</th>
                                <th scope="col" class="px-6 py-3">Protin</th>
                                <th scope="col" class="px-6 py-3">Fat</th>
                                <th scope="col" class="px-6 py-3">Carbohydrates</th>
                                {{-- <th scope="col" class="px-6 py-3">Is Vegan?</th> --}}
                                <th scope="col" class="px-6 py-3">Is Gluten Free?</th>
                                {{-- <th scope="col" class="px-6 py-3">Origin</th> --}}
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700" v-for="(data, i) in foodList" :key="i">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.category ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.name ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.quantity ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.unit ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.calories ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.protin ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.fat ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.carbohydrates ?? "N/A" }}</td>
                                {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.is_vegan ? "Yes"  : "No"}}</td> --}}
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.is_gluten_free ? "Yes" : "No" }}</td>
                                {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.origin ?? "N/A" }}</td> --}}
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a :href="'user-problem/'+ data.id"
                                        class="text-white bg-gray-300 hover:bg-gray-700 focus:outline-none
                                        focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                        px-5 py-2 me-2 mb-2 dark:bg-gray-500 dark:hover:bg-gray-600 
                                        dark:focus:ring-gray-500 dark:border-gray-600">
                                        View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <button
                            href="#"
                            class="prev"
                            :class="{ disabled: foodPagination.page === 1 }"
                            @click="goToFoodPage(foodPagination.page - 1)"
                            aria-label="Previous"
                            >
                            &laquo; Previous
                        </button>

                        <button
                            href="#"
                            class="next"
                            :class="{ disabled: foodPagination.page === foodPagination.totalPages }"
                            @click="goToFoodPage(foodPagination.page + 1)"
                            aria-label="Next"
                            >
                            Next &raquo;
                        </button>
                    </div>
                </div>

                <div v-if="tabSection==3" class="relative custom-card overflow-x-auto rounded-lg w-full">
                    <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Your Medecine List</label>
    
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Frequency</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700" v-for="(data, i) in medecineList" :key="i">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.name ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.quantity ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.frequency ?? "N/A" }}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a :href="'user-problem/'+ data.id"
                                        class="text-white bg-gray-300 hover:bg-gray-700 focus:outline-none
                                        focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                        px-5 py-2 me-2 mb-2 dark:bg-gray-500 dark:hover:bg-gray-600 
                                        dark:focus:ring-gray-500 dark:border-gray-600">
                                        View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <button
                            href="#"
                            class="prev"
                            :class="{ disabled: medecinePagination.page === 1 }"
                            @click="goToMedecinePage(medecinePagination.page - 1)"
                            aria-label="Previous"
                            >
                            &laquo; Previous
                        </button>

                        <button
                            href="#"
                            class="next"
                            :class="{ disabled: medecinePagination.page === medecinePagination.totalPages }"
                            @click="goToMedecinePage(medecinePagination.page + 1)"
                            aria-label="Next"
                            >
                            Next &raquo;
                        </button>
                    </div>
                </div>

            </div>


        </div>
    </div>

    <script type="text/javascript" src="{{ asset('') }}js/vue.js"></script>
    <script type="text/javascript" src="{{asset('')}}js/axios.js"></script>

    <script>
        new Vue({
            el: "#main-section",
            data: {
                isLoading: false,
                error: [],
                error_message: '',
                success_message: '',
                currentUserProblemId:'',
                tabSection : 1,
                appointmentPagination: {
                    page: 1,
                    totalCount: '',
                    totalPages:''
                },
                foodPagination: {
                    page: 1,
                    totalCount: '',
                    totalPages:''
                },
                medecinePagination: {
                    page: 1,
                    totalCount: '',
                    totalPages:''
                },
                appointmentList:[],
                foodList:[],
                medecineList:[],
            },

            mounted() {
                this.getAppointmentList();
            },

            methods: {
                getAppointmentList(page = this.appointmentPagination.page) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `/appointments/`+this.currentUserProblemId;
                    let dataForm = {
                        page: page
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
                        console.log(response)
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.appointmentList = response.data.appointments.data;
                        _that.appointmentPagination.page = response.data.appointments.current_page
                        _that.appointmentPagination.totalCount = response.data.appointments.total
                        _that.appointmentPagination.totalPages = response.data.appointments.last_page
                    }).catch(function (error) {
                        _that.isLoading = false;

                        if (error.response && error.response.status === 422) {
                            _that.error_message = "";
                            if (error.response.data.errors) {
                                for (const [key, messages] of Object.entries(error.response.data.errors)) {
                                    _that.error_message += messages.join('<br>') + '<br>';
                                }
                            } else {
                                _that.error_message = error.response.data.message;
                            }
                        } else {
                            _that.error_message = "An unexpected error occurred.";
                        }
                    });
                },

                getFoodList(page = this.foodPagination.page) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `/foods/`+this.currentUserProblemId;
                    let dataForm = {
                        page: page
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.foodList = response.data.foods.data;
                        _that.foodPagination.page = response.data.foods.current_page
                        _that.foodPagination.totalCount = response.data.foods.total
                        _that.foodPagination.totalPages = response.data.foods.last_page
                    }).catch(function (error) {
                        _that.isLoading = false;

                        if (error.response && error.response.status === 422) {
                            _that.error_message = "";
                            if (error.response.data.errors) {
                                for (const [key, messages] of Object.entries(error.response.data.errors)) {
                                    _that.error_message += messages.join('<br>') + '<br>';
                                }
                            } else {
                                _that.error_message = error.response.data.message;
                            }
                        } else {
                            _that.error_message = "An unexpected error occurred.";
                        }
                    });
                },

                getMedecineList(page = this.medecinePagination.page) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `/medecines/`+this.currentUserProblemId;
                    let dataForm = {
                        page: page
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.medecineList = response.data.medecines.data;
                        _that.medecinePagination.page = response.data.medecines.current_page
                        _that.medecinePagination.totalCount = response.data.medecines.total
                        _that.medecinePagination.totalPages = response.data.medecines.last_page
                    }).catch(function (error) {
                        _that.isLoading = false;

                        if (error.response && error.response.status === 422) {
                            _that.error_message = "";
                            if (error.response.data.errors) {
                                for (const [key, messages] of Object.entries(error.response.data.errors)) {
                                    _that.error_message += messages.join('<br>') + '<br>';
                                }
                            } else {
                                _that.error_message = error.response.data.message;
                            }
                        } else {
                            _that.error_message = "An unexpected error occurred.";
                        }
                    });
                },
                
                tabChange(tab) {
                    this.tabSection = tab;
                    if(tab == 1) {
                        this.getAppointmentList();
                    }else if(tab == 2) {
                        this.getFoodList();
                    }else if(tab == 3){
                        this.getMedecineList()
                    }
                },

                goToAppointmentPage(page) {
                    console.log(this.appointmentPagination)
                    if (page < 1 || page > this.appointmentPagination.totalPages) return;
                    this.getAppointmentList(page);
                },

                goToFoodPage(page) {
                    console.log(this.foodPagination)
                    if (page < 1 || page > this.foodPagination.totalPages) return;
                    this.getFoodList(page);
                },

                goToMedecinePage(page) {
                    console.log(this.medecinePagination)
                    if (page < 1 || page > this.medecinePagination.totalPages) return;
                    this.getMedecineList(page);
                },
            },

            created() {
                this.currentUserProblemId = `{{$user_problem->id}}`;
            },
        });
    </script>
</x-app-layout>

