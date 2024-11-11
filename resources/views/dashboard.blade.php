<x-app-layout>
    <x-slot name="header">
        <div class="mx-auto rounded-lg overflow-hidden p-4" style="background: linear-gradient(12deg, #330000 0%, #00086df2 100%);">
            <div class="flex items-center justify-between">  
                <div class="relative flex justify-center">
                    <dotlottie-player src="https://lottie.host/1b4c86fb-8a42-45cf-882f-9eba3545920a/1nkzV3BqTx.json" background="transparent" speed="1" style="width: 200px; height: 200px;" loop autoplay></dotlottie-player>
                </div>
                
                <div class="text-center text-white">
                    <h1 class="main-title mx-4">
                        WELCOME TO "GENIE" : WOMEN AI HEALTH ASSITANCE
                    </h1>
                </div>
            </div>
          </div>
    </x-slot>

    <div class="mx-auto px-8" id="main-section">

        <div v-if="error_message" id="toast-default" style="justify-content: space-between" class="mb-4 flex w-full p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="ms-3 text-sm text-red-600 font-normal">
                @{{error_message}}
            </div>
            <button type="button" class="ms-auto w-4 flex -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
{{-- 
        <div v-if="success_message" id="toast-default" style="justify-content: space-between" class="mb-4 flex w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
            <div class="ms-3 text-sm text-green-600 font-normal">
                @{{success_message}}
            </div>
            <button type="button" class="ms-auto w-4 flex -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div> --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="">
                    <div class="issue-form custom-card p-6 sm:rounded-lg">
                        <label class="block pb-6 text-lg font-bold text-gray-700 dark:text-gray-300">Submit Your Current Health Issue</label>
                        
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select Health Category</label>
                            <select id="category" v-model="formHealthProblemInfo.category_id" @change="getProblemList"
                                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white">
                                <option selected disabled>-- Choose One --</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select Health Issue Related to You</label>
                            <select id="problem" v-model="formHealthProblemInfo.problem_id" @change="setHealthProblemDetails"
                                class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white">
                                <option selected disabled>-- Choose One --</option>
                                <option v-for="(problem, i) in problemList" :key="i" :value="problem.id">@{{problem.title}}</option>
                            </select>
                        </div>

                        <div class="w-full mx-auto mt-4">
                            <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">In-details</label>
                            <textarea v-model="formHealthProblemInfo.details"
                            class="w-full p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"
                            placeholder="Details of your problem here..."
                            ></textarea>
                        </div>

                        <div class="flex items-start mb-6 mt-4">
                            <div class="flex items-center h-5">
                            <input v-model="formHealthProblemInfo.visited_doctor" @click="appointmentForm=!formHealthProblemInfo.visited_doctor" id="visited_doctor" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required />
                            </div>
                            <label for="visited_doctor" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I have visited a doctor recently.</label>
                        </div>

                        <div v-show="appointmentForm">
                                <div class="grid gap-4 mb-4 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1">
                                    <div>
                                        <label for="appointment_date" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                        <input v-model="formHealthProblemInfo.appointment_date" type="date" id="appointment_date" class="common-bg w-full p-2.5 text-black-900 text-sm rounded-lg dark:text-white" placeholder="John" required />
                                    </div>
                                    <div>
                                        <label for="appointment_time" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                                        <input v-model="formHealthProblemInfo.appointment_time" type="time" id="appointment_time" class="common-bg w-full p-2.5 text-black-900 text-sm rounded-lg dark:text-white" placeholder="Doe" required />
                                    </div>
                                </div>
                        </div>

                        <div class="justify-end flex">
                            <button type="button" @click="healthIssueInfoSubmit()"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                    focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                    px-5 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                    dark:focus:ring-gray-700 dark:border-gray-700" style="float: right;">
                                Submit
                            </button>
                        </div>
                    </div>

                    <div class="shadow-sm sm:rounded-lg mt-4">
                        <!-- First Table -->
                        <div class="relative custom-card overflow-x-auto rounded-lg">
                            <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">My Health Issues</label>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        {{-- <th scope="col" class="px-6 py-3">Category</th>
                                        <th scope="col" class="px-6 py-3">Problem</th> --}}
                                        <th scope="col" class="px-6 py-3">Health Issue</th>
                                        <th scope="col" class="px-6 py-3">Appointments</th>
                                        <th scope="col" class="px-6 py-3">Foods</th>
                                        <th scope="col" class="px-6 py-3">Medicines</th>
                                        <th scope="col" class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="(data, i) in userProblemList" :key="i">
                                        {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.category.name }}

                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.problem.title }}

                                        </td> --}}
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.category.name }}
                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.appointments_count }}

                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.foods_count }}

                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            
                                                @{{ data.medicines_count }}

                                        </td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a :href="'user-problem/'+ data.id"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                    focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                    px-2 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                    dark:focus:ring-gray-700 dark:border-gray-700">
                                                View
                                            </a>
                                            <a :href="'user-problem/'+ data.id"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                px-2 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                dark:focus:ring-gray-700 dark:border-gray-700">
                                            Follow-Up
                                        </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pagination">
                                <button
                                href="#"
                                class="prev"
                                :class="{ disabled: userProblemPagination.page === 1 }"
                                @click="goToUserProblemPage(userProblemPagination.page - 1)"
                                aria-label="Previous"
                                >
                                &laquo; Previous
                            </button>
                            
                                {{-- <div class="page-numbers">
                                <a
                                    v-for="page in pageNumbers"
                                    :key="page"
                                    :href="`http://127.0.0.1:8000/appointments?page=${page}`"
                                    :class="{ active: page === userProblemCurrentPage }"
                                    @click.prevent="goToUserProblemPage(page)"
                                >
                                    {{ page }}
                                </a>
                                <span class="dots" v-if="hasMorePages">...</span>
                                </div> --}}
                            
                                <button
                                href="#"
                                class="next"
                                :class="{ disabled: userProblemPagination.page === userProblemPagination.totalPages }"
                                @click="goToUserProblemPage(userProblemPagination.page + 1)"
                                aria-label="Next"
                                >
                                Next &raquo;
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="shadow-sm sm:rounded-lg mt-4">
                        <!-- Second Table -->
                        <div class="relative custom-card overflow-x-auto rounded-lg">
                        <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">My Appointments</label>

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Health Issue</th>
                                        <th scope="col" class="px-6 py-3">Date</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="(data, i) in appointmentList" :key="i">
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.user_problem?.problem?.category?.name }}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.appointment_date }}</td>
                                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{ data?.statusLabel }}</td>
                                        
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
                            
                                {{-- <div class="page-numbers">
                                <a
                                    v-for="page in pageNumbers"
                                    :key="page"
                                    :href="`http://127.0.0.1:8000/appointments?page=${page}`"
                                    :class="{ active: page === userProblemCurrentPage }"
                                    @click.prevent="goToAppointmentPage(page)"
                                >
                                    {{ page }}
                                </a>
                                <span class="dots" v-if="hasMorePages">...</span>
                                </div> --}}
                            
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
                    </div>
            </div>

            <div class="custom-card sm:rounded-lg ai-chat-section">
                <div class="p-6 text-gray-900 w-full">
                    <div class="flex flex-col gap-4" v-show="aiConversetions.length > 0">

                        <!-- Chat Messages Section -->
                        <div class="flex-1" v-for="(data, i) in aiConversetions" :key="i">

                            <!-- Chat Messages -->
                            <div class="" v-if="data.ai">
                                <component :is="data.content" v-if="data.component" :data="data.data"></component>
                                <div v-else class="grid gap-4 ai-content p-3 rounded-lg" v-html="data.content">
                                </div>
                            </div>
                            
                            <div class="flex justify-end" v-else>
                                <div class="user-content p-3 rounded-lg">
                                    @{{data.content}}
                                </div>
                            </div>

                        </div>
                    
                        <!-- Chat Section -->
                        <div class="mt-2">

                            <div class="grid gap-2 mb-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1">
                                <button v-for="(question, i) in questionList" :key="i" @click="predefineQuestionHandler(question.id, question.user_question)" class="text-start w-full p-2 bg-white text-black-900 text-sm rounded-lg focus:ring-blue-500 dark:bg-gray-800 dark:text-white dark:focus:ring-blue-500">
                                    @{{question.user_question}}
                                </button>
                            </div>

                            <div class="flex gap-2 mb-4">
                                <textarea v-model="user_prompt"
                                    class="w-full p-2.5 bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500  dark:bg-gray-800 dark:text-white dark:focus:ring-blue-500" 
                                    placeholder="Type your message..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" @click="aiConversetionHandler()"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none
                                focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                px-2 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                dark:focus:ring-gray-700 dark:border-gray-700">
                                Send
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script type="text/javascript" src="{{ asset('') }}js/vue.js"></script>
    <script type="text/javascript" src="{{asset('')}}js/axios.js"></script>

    <script>
        //appointments
        Vue.component('ai-suggested-appointment-component', {
            props: ['data'],
            data() {
                return {
                    formAppointmentAdd:{
                        date:'',
                        currentUserProblemId: ''
                    }
                }
            },
            template: `
            <div class="relative custom-card overflow-x-auto rounded-lg">
            <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Ai Suggested Appointments</label>
            <ul style="list-style-type: none; padding: 0; margin: 0; display: grid; flex-wrap: wrap;">
                <li v-for="(item, index) in data.list" :key="index" 
                    style="display: inline-flex; align-items: center; justify-content: space-between; padding: 10px; border: 1px solid #e2e8f0; margin-bottom: 4px; border-radius: 8px;">
                    
                    <input type="date" :value="item.date" class="p-2.5 text-gray-900 text-sm rounded-lg common-bg dark:text-white"/>
                    
                    <button 
                        @click="add(item.date)" 
                        type="button" 
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                    focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                    px-5 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                    dark:focus:ring-gray-700 dark:border-gray-700" 
                                    aria-label="Check">
                        
                        Add
                        
                    </button>
                </li>
            </ul>
            </div>
            `,
            methods: {
                add(date) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    _that.formAppointmentAdd = {
                        date : date,
                        user_problem_id: this.data.currentUserProblemId
                    }

                    let pageUrl = `{{ route('appointment.store') }}`;
                    _that.isLoading = true;
                    axios.post(pageUrl, _that.formAppointmentAdd).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;

                        if (response.data.status === 200) {
                            _that.success_message = response.data.message;
                            let list = _that.data.list
                            _that.data.list = list.filter(item => item.date !== _that.formAppointmentAdd.date);
                            _that.error = [];
                        } else {
                            _that.error_message = response.data.message;
                        }
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
                    
                }
            }
        });

        //food
        Vue.component('ai-suggested-food-component', {
            props: ['data'],
            data() {
                return {
                    formFoodAdd:{
                        name:'',
                        currentUserProblemId: ''
                    }
                }
            },
            template: `
                <div class="relative custom-card overflow-x-auto rounded-lg">
                <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Ai Suggested Food List</label>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Unit</th>
                                <th scope="col" class="px-6 py-3">Calories</th>
                                <th scope="col" class="px-6 py-3">protein</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(item, index) in data.list" :key="index">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.name}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.quantity}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.unit}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.calories}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.protein}}</td>
                                <td class="text-center">
                                    <button 
                                        @click="add(item)" 
                                        type="button" 
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                            focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                            px-5 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                            dark:focus:ring-gray-700 dark:border-gray-700" 
                                            aria-label="Check">
                                        Add
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `,
            methods: {
                add(item) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    _that.formFoodAdd = {
                        data : item,
                        user_problem_id: this.data.currentUserProblemId
                    }

                    let pageUrl = `{{ route('food.store') }}`;
                    _that.isLoading = true;
                    axios.post(pageUrl, _that.formFoodAdd).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;

                        if (response.data.status === 200) {
                            _that.success_message = response.data.message;
                            let list = _that.data.list
                            _that.data.list = list.filter(item => item.name !== _that.formFoodAdd.data.name);
                            _that.error = [];
                        } else {
                            _that.error_message = response.data.message;
                        }
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
                    
                }
            }
        });

        //medicine
        Vue.component('ai-suggested-medicine-component', {
            props: ['data'],
            data() {
                return {
                    formFoodAdd:{
                        name:'',
                        currentUserProblemId: ''
                    }
                }
            },
            template: `
                <div class="relative custom-card overflow-x-auto rounded-lg">
                <label class="block px-6 py-4 text-lg font-bold custom-label text-gray-700 dark:text-gray-300">Ai Suggested Medicine List</label>

                    <table v-if="data.list.length > 0" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Quantity</th>
                                <th scope="col" class="px-6 py-3">Unit</th>
                                <th scope="col" class="px-6 py-3">Frequency</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(item, index) in data.list" :key="index">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.name}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.quantity}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.unit}}</td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@{{item.frequency}}</td>
                                <td class="text-center"> 
                                    <button v-if="item?.name"
                                        @click="add(item)" 
                                        type="button" 
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                            focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                            px-5 py-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                            dark:focus:ring-gray-700 dark:border-gray-700" 
                                        aria-label="Check">
                                        
                                        Add
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h3 v-else class="text-red-200 text-bold p-2 text-center" > For medecines, Please visit your doctor </h3>
                </div>
            `,
            methods: {
                add(item) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    _that.formMedicineAdd = {
                        data : item,
                        user_problem_id: this.data.currentUserProblemId
                    }

                    let pageUrl = `{{ route('medicine.store') }}`;
                    _that.isLoading = true;
                    axios.post(pageUrl, _that.formMedicineAdd).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;

                        if (response.data.status === 200) {
                            _that.success_message = response.data.message;
                            let list = _that.data.list
                            _that.data.list = list.filter(item => item.name !== _that.formMedicineAdd.data.name);
                            _that.error = [];
                        } else {
                            _that.error_message = response.data.message;
                        }
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
                    
                }
            }
        });

        new Vue({
            el: "#main-section",
            data: {
                isLoading: false,
                error: [],
                error_message: '',
                success_message: '',
                currentUserProblemId:'',
                appointmentForm: false,
                htmlContent: '',
                aiConversetions: [{
                    ai: true,
                    content: "Hi! You have a health issue? Well, I'm here to help you.",
                    component: false,
                    data:[]
                }],
                problemList: [],
                userProblemList:[],
                userProblemPagination: {
                    page: 1,
                    totalCount: '',
                    totalPages:''
                },
                appointmentList:[],
                appointmentPagination: {
                    page: 1,
                    totalCount: '',
                    totalPages:''
                },
                questionList:[],
                formHealthProblemInfo:{
                    category_id:'',
                    problem_id:'',
                    details:'',
                    visited_doctor: false,
                    appointment_date:'',
                    appointment_time:'',
                },
                user_prompt:''
            },

            mounted() {
                this.getUserProblemList();
                this.getAppointmentList();
            },
            methods: {
                getProblemList() {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `{{ route('category-to-problems') }}`;
                    let dataForm = {
                        categoryId: _that.formHealthProblemInfo.category_id
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.problemList = response.data.data;
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

                getUserProblemList(page = this.userProblemPagination.page) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `{{ route('user-problem') }}`;
                    let dataForm = {
                        params: {
                            page: page
                        }
                    };

                    axios.get(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.userProblemList = response.data.userProblems.data;
                        _that.userProblemPagination.page = response.data.userProblems.current_page
                        _that.userProblemPagination.totalCount = response.data.userProblems.total
                        _that.userProblemPagination.totalPages = response.data.userProblems.last_page
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

                getAppointmentList(page = this.appointmentPagination.page) {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `{{ route('appointments') }}`;
                    let dataForm = {
                        page: page
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
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

                healthIssueInfoSubmit() {
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    _that.formHealthProblemInfoValidation();

                    if (_that.error.length > 0) {
                        _that.error_message = _that.error.join('<br>');
                        return false;
                    }

                    _that.aiConversetions.push({
                        ai: false,
                        content: "Health Issue Submited."
                    });

                    let pageUrl = `{{ route('health-issue-info.store') }}`;
                    _that.isLoading = true;
                    axios.post(pageUrl, _that.formHealthProblemInfo).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;

                        if (response.data.status === 200) {
                            _that.currentUserProblemId = response.data.userProblemId;
                            _that.aiConversetions.push({
                                ai: true,
                                content: response.data.htmlContent
                            });
                            _that.success_message = response.data.message;
                            _that.questionList = response.data.questionList;
                            _that.formHealthProblemInfo = {
                                category_id:'',
                                problem_id:'',
                                details:'',
                                visited_doctor: false,
                                appointment_date:'',
                                appointment_time:'',
                            };
                            _that.getUserProblemList();
                            _that.getAppointmentList();
                            _that.error = [];
                        } else {
                            _that.error_message = response.data.message;
                        }
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

                setHealthProblemDetails() {
                    const problem = this.problemList.find(p => p.id === parseInt(this.formHealthProblemInfo.problem_id));
                    this.formHealthProblemInfo.details = problem?.description ?? "";
                },

                formHealthProblemInfoValidation() {
                    if (this.formHealthProblemInfo.category_id === "") this.error.push('Health Issue Category Field is Required');
                    if (this.formHealthProblemInfo.problem_id === "") this.error.push('Health Issue Field is Required');
                    if(this.formHealthProblemInfo.visited_doctor) {
                        if (this.formHealthProblemInfo.appointment_date === "") this.error.push('Appointment Date is Required');
                        if (this.formHealthProblemInfo.appointment_time === "") this.error.push('Appointment Time is Required');
                    }
                },

                predefineQuestionHandler(questionId, question){
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    let pageUrl = `{{ route('ai-format') }}`;
                    let dataForm = {
                        questionId: questionId,
                        chatHistorry: _that.aiConversetions
                    };
                    _that.aiConversetions.push({
                        ai: false,
                        content: question
                    });
                    axios.post(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;

                        if (response.data.status === 200) {
                            if(response.data.type == "appointments"){
                                _that.aiConversetions.push({
                                ai: true,
                                content: 'ai-suggested-appointment-component',
                                data: {
                                    list: response.data.list,
                                    currentUserProblemId: _that.currentUserProblemId
                                },
                                component: true
                            });
                            }else if(response.data.type == "food"){
                                _that.aiConversetions.push({
                                ai: true,
                                content: 'ai-suggested-food-component',
                                data: {
                                    list: response.data.list,
                                    currentUserProblemId: _that.currentUserProblemId
                                },
                                component: true
                            });
                            }else if(response.data.type == "medicine"){
                                _that.aiConversetions.push({
                                ai: true,
                                content: 'ai-suggested-medicine-component',
                                data: {
                                    list: response.data.list,
                                    currentUserProblemId: _that.currentUserProblemId
                                },
                                component: true
                            });
                            }
                            _that.success_message = response.data.message;
                            _that.removeAskedQuestFromList(questionId);
                        } else {
                            _that.aiConversetions.push({
                                ai: true,
                                content: response.data.message
                            });
                        }
                    }).catch(function (error) {
                        _that.isLoading = false;

                        if (error.response && error.response.status === 422) {
                            _that.error_message = "";
                            if (error.response.data.errors) {
                                for (const [key, messages] of Object.entries(error.response.data.errors)) {
                                    _that.error_message += messages.join('<br>') + '<br>';
                                }
                            } else {
                                _that.aiConversetions.push({
                                    ai: true,
                                    content: error.response.data.message
                                });
                            }
                        } else {
                            _that.aiConversetions.push({
                                ai: true,
                                content: "An unexpected error occurred."
                            });
                        }
                    });
                },
                
                aiConversetionHandler(){
                    let _that = this;
                    _that.error = [];
                    _that.error_message = "";
                    _that.success_message = "";
                    _that.aiConversetions.push({
                        ai: false,
                        content: this.user_prompt
                    });
                    let pageUrl = `{{ route('ai-chat') }}`;
                    let dataForm = {
                        chatHistorry: this.aiConversetions
                    };

                    axios.post(pageUrl, dataForm).then(function (response) {
                        _that.isLoading = false;
                        _that.error_message = "";
                        _that.success_message = "";
                        _that.isLoading = false;
                        if (response.data.status === 200) {
                            _that.aiConversetions.push({
                                ai: true,
                                content: response.data.htmlContent
                            });
                            _that.success_message = response.data.message;
                            _that.user_prompt = '';
                        } else {
                            _that.error_message = response.data.message
                        }
                    }).catch(function (error) {
                        _that.isLoading = false;

                        if (error.response && error.response.status === 422) {
                            _that.error_message = "";
                            if (error.response.data.errors) {
                                for (const [key, messages] of Object.entries(error.response.data.errors)) {
                                    _that.error_message += messages.join('<br>') + '<br>';
                                }
                            } else {
                                _that.error_message = error.response.data.message
                            }
                        } else {
                            _that.error_message = "An unexpected error occurred."
                        }
                    });
                },

                removeAskedQuestFromList(idToRemove){
                    this.questionList = this.questionList.filter(item => item.id !== idToRemove);
                },

                goToUserProblemPage(page) {
                    if (page < 1 || page > this.userProblemPagination.totalPages) return;
                    this.getUserProblemList(page);
                },

                goToAppointmentPage(page) {
                    if (page < 1 || page > this.appointmentPagination.totalPages) return;
                    this.getAppointmentList(page);
                },

                check(id){
                    console.log(id)
                },

                limitToWords(text){
                    if (!text) return '';
                    const words = text.split(' ');
                    return words.length > wordLimit
                        ? words.slice(0, wordLimit).join(' ') + '...'
                        : text;
                }
            },

            created() {

            },
        });
    </script>
</x-app-layout>
