<x-app-layout>
    <x-slot name="header">

        
    </x-slot>

    <div class="container mx-auto p-4" id="main-section">
        <!-- Two-column layout -->
        <div v-if="error_message" id="toast-default" style="justify-content: space-between" class="mb-4 flex w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- First Column: Textarea -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">

                    <!-- First Dropdown -->
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select Health Category</label>
                        <select id="category" v-model="formHealthProblemInfo.category_id" @change="getProblemList"
                            class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>-- Choose One --</option>
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <!-- Second Dropdown -->
                    <div>
                        <label for="problem" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Select Health Issue Related to You</label>
                        <select id="problem" v-model="formHealthProblemInfo.problem_id" @change="setHealthProblemDetails"
                            class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>-- Choose One --</option>
                            <option v-for="(problem, i) in problemList" :key="i" :value="problem.id">@{{problem.title}}</option>
                        </select>
                    </div>

                    <div class="w-full mx-auto">
                        <textarea v-model="formHealthProblemInfo.details"
                          class="w-full h-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Details of your problem here..."
                        ></textarea>
                    </div>

                    <div class="flex items-start mb-6 mt-2">
                        <div class="flex items-center h-5">
                        <input v-model="formHealthProblemInfo.visited_doctor" @click="appointmentForm=!formHealthProblemInfo.visited_doctor" id="visited_doctor" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required />
                        </div>
                        <label for="visited_doctor" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I have visited a doctor recently.</label>
                    </div>

                    <div v-show="appointmentForm">
                            <div class="grid gap-4 mb-4 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1">
                                <div>
                                    <label for="appointment_date" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                    <input v-model="formHealthProblemInfo.appointment_date" type="date" id="appointment_date" class="w-full p-2.5 bg-white border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                                </div>
                                <div>
                                    <label for="appointment_time" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Time</label>
                                    <input v-model="formHealthProblemInfo.appointment_time" type="time" id="appointment_time" class="w-full p-2.5 bg-white border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                                </div>
                            </div>
                    </div>


                    <div class="justify-end">
                        <button type="button" @click="healthIssueInfoSubmit()"
                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none 
                                   focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                   px-5 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                   dark:focus:ring-gray-700 dark:border-gray-700" style="float: right;">
                            Submit
                        </button>
                    </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col h-screen max-h-screen" v-show="aiConversetions.length > 0">

                        <!-- Chat Messages Section -->
                        <div class="flex-1 overflow-y-auto p-4 bg-gray-100" v-for="(data, i) in aiConversetions" :key="i">

                            <!-- Chat Messages -->
                            <div class="mb-4" v-if="data.ai">
                                <div class="grid gap-4 bg-gray-300 text-black p-3 rounded-lg w-fit max-w-xs" v-html="data.content">
                                </div>
                            </div>
                            
                            <div class="mb-4 flex justify-end" v-else>
                                <div class="bg-blue-500 p-3 rounded-lg w-fit max-w-xs">
                                    @{{data.content}}
                                </div>
                            </div>

                        </div>
                    
                        <!-- Chat Section -->
                        <div class="mt-2">

                            <div class="grid gap-2 mb-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1">
                                <button v-for="(question, i) in questionList" :key="i" class="text-start w-full p-2 bg-white border border-gray-300 text-black-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @{{question}}
                                </button>
                            </div>

                            <div class="flex gap-2 mb-2">
                                <textarea 
                                    class="flex-1 resize-none h-12 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    placeholder="Type your message..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" 
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none
                                focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm 
                                px-5 py-2 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 
                                dark:focus:ring-gray-700 dark:border-gray-700">
                                Send
                            </button>
                            </div>

                        </div>

                    </div>
                    
                </div>
            </div>

    
            <!-- Second Column: Tables -->
            <div class="space-y-6">
                <!-- First Table -->
                
                <div class="relative overflow-x-auto shadow-md rounded-lg">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">My Health Issues</label>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Product Name</th>
                                <th scope="col" class="px-6 py-3">Color</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="px-6 py-4">Silver</td>
                                <td class="px-6 py-4">Laptop</td>
                                <td class="px-6 py-4">$2999</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Microsoft Surface Pro
                                </th>
                                <td class="px-6 py-4">White</td>
                                <td class="px-6 py-4">Laptop PC</td>
                                <td class="px-6 py-4">$1999</td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Magic Mouse 2
                                </th>
                                <td class="px-6 py-4">Black</td>
                                <td class="px-6 py-4">Accessories</td>
                                <td class="px-6 py-4">$99</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
                <!-- Second Table -->
                <div class="relative overflow-x-auto shadow-md rounded-lg">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">My Appointments</label>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Product Name</th>
                                <th scope="col" class="px-6 py-3">Color</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Dell XPS 13
                                </th>
                                <td class="px-6 py-4">Black</td>
                                <td class="px-6 py-4">Laptop</td>
                                <td class="px-6 py-4">$999</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    HP Spectre x360
                                </th>
                                <td class="px-6 py-4">Silver</td>
                                <td class="px-6 py-4">Laptop</td>
                                <td class="px-6 py-4">$1299</td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Apple AirPods Pro
                                </th>
                                <td class="px-6 py-4">White</td>
                                <td class="px-6 py-4">Accessories</td>
                                <td class="px-6 py-4">$249</td>
                            </tr>
                        </tbody>
                    </table>
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
                appointmentForm: false,
                htmlContent: '',
                aiConversetions: [],
                problemList: [],
                questionList:[],
                formHealthProblemInfo:{
                    category_id:'',
                    problem_id:'',
                    details:'',
                    visited_doctor: false,
                    appointment_date:'',
                    appointment_time:'',
                }
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
                        _that.aiConversetions.push({
                            ai: true,
                            content: response.data.htmlContent
                        });
                        if (response.data.status === 200) {
                            _that.success_message = response.data.htmlContent;
                            _that.questionList = response.data.questionList;
                            _that.formHealthProblemInfo = {
                                category_id:'',
                                problem_id:'',
                                details:'',
                                visited_doctor: false,
                                appointment_date:'',
                                appointment_time:'',
                            };
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
            },

            created() {

            },
        });
    </script>
</x-app-layout>
