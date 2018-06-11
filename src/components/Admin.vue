<template>
    <div class="container-fluid">
        <div class="row p-4 m-0"><img src="dist/image/panscifi_logo.png"></div>
        <div class="row p-2"></div>
        <div class="row p-4 m-0"><h3>參賽稿件管理</h3></div>
        <div class="row p-4 m-0">
            <div class="col-12">
                <form @submit.prevent="submit($event)">
                    <input type="text" name="key" placeholder="請輸入關鍵字或投稿編號">
                    <select name="novel_type" class="ml-5" placeholder="請選擇投稿獎項">
                        <option value="0">全部</option>
                        <option value="1">短篇小說</option>
                        <option value="2">中短篇小說</option>
                    </select>
                    <button type="submit" class="btn btn-primary ml-2">搜尋</button>
                </form>
            </div>
        </div>
        <div class="row p-5 m-0">
            <b>全部 : {{ all_total }} 人 | 短篇小說: {{ short_total }} 人 | 中短篇小說 : {{ novella_total }} 人</b> 
        </div>
        <div class="row">
            <table class="table">   
                <thead>
                    <th>#</th>
                    <th>上傳時間</th>
                    <th>投稿編號</th>
                    <th>姓名</th>
                    <th>筆名</th>
                    <th>Email</th>
                    <th>聯絡電話</th>
                    <th>投稿項目</th>
                    <th>檔案大小</th>
                    <th>作品</th>
                    <th>同意書</th>
                    <th>備註</th>
                    <th>功能</th>
                </thead>
                <tbody>
                    <tr v-for="( item,index ) in novel_data">
                        <td>{{ index+1 }}</td>
                        <td>{{ item.up_date }}</td>
                        <td>{{ item.novel_no }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.pan_name }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td><span class='badge badge-secondary'>{{ novel_type(index) }}</span></td>
                        <td>{{ (item.novel_file_size /1024/1024).toFixed(1) }} MB</td>
                        <td><a :href="item.novel_file_name" :download="item.novel_no + '-作品'"  class="btn btn-primary">下載</a></td>
                        <td><a :href="item.agreement_file_name" :download="item.novel_no + '-同意書'" class="btn btn-primary">下載</a></td>
                        <td><textarea id="note" v-model="novel_data[index].note" name="note" cols="10" rows="1"></textarea></td>
                        <td><a href='javascript:void(0)' @click="save_note(item.novel_no,index)" class="btn btn-outline-primary">儲存</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="search result ">
          <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link" @click="submit(current_page-1)" href="javascript:void(0)">Previous</a></li>
            <li class="page-item" v-for="n in return_page_count"><a class="page-link" @click="submit(n)" href="javascript:void(0)"> {{ n }} </a></li>
            <li class="page-item"><a class="page-link" @click="submit(current_page+1)" href="javascript:void(0)">Next</a></li>
          </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'Admin',
        data () {
            return {
                all_total: 0,
                short_total: 0,
                novella_total: 0,
                current_page: 1,
                page_count: 0,
                data_count: 25,
                novel_data: [],
                page_item:{}
            }
        },
        created() {
            this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all',{novel_type: 1},{emulateJSON: true}).then(success => {
                    this.short_total = success.data.data.length
                },error => {
                    console.log(error)
                })

            this.$http.post('http://pansf-upload.panmedia.asia/console/novel/all', {novel_type: 2}, {emulateJSON: true}).then(success => {
                    this.novella_total = success.data.data.length
                },error => {
                    console.log(error)
                })

            this.$http.get('http://pansf-upload.panmedia.asia/console/admin/admin_all').then( success => { 
                if( success.status == 200 ) {
                    const resource = success.data.data
                    if (resource != '') {
                        for( var i=0; i<this.data_count; i++){
                            if( resource[i] !=null){
                                resource[i].novel_file_name = '/console/assets/file/source/' + resource[i].novel_file_name
                                resource[i].agreement_file_name = '/console/assets/file/uploads/' + resource[i].agreement_file_name
                                this.novel_data[i] = resource[i]
                            }
                        }
                        this.all_total = resource.length
                    }
                }
            },error => {
                console.log(error);
            })
        },mounted() {
          if( this.getCookie('success') == null ) {
            window.location = '/adminlogin';
          }
        },

        computed: {
            return_page_count() {
                const page_count = Math.ceil(this.all_total / this.data_count)
                this.page_count = page_count;
                return page_count;
            },
           
        },
        methods:{
            submit(n) {
                const formData = new FormData($('form')[0])
                if(n != null ){
                    if( n < 1){
                        n = 1
                    }
                    if( n > this.page_count){
                        n = this.page_count
                    }
                    this.current_page = n;
                    this.$http.post('http://pansf-upload.panmedia.asia/console/admin/search?pagestart=' + ((n-1)*this.data_count) + '&count=' + this.data_count, formData,{emulateJSON: true}).then(
                        success => {
                            if( success.status == 200) {
                                const resource = success.data.data
                                if (resource != '') {
                                    resource[0].novel_file_name = '/console/assets/file/source/' + resource[0].novel_file_name
                                    resource[0].agreement_file_name = '/console/assets/file/uploads/' + resource[0].agreement_file_name
                                    this.novel_data = resource
                                } else {
                                    this.novel_data = ''
                                    alert('查無資料');
                                }
                            }
                        },
                        error => {
                            console.log(error);
                        }
                    )
                } else {
                    this.$http.post('http://pansf-upload.panmedia.asia/console/admin/search', formData,{emulateJSON: true}).then(
                        success => {
                            if( success.status == 200) {
                                const resource = success.data.data
                                if (resource != '') {
                                    resource[0].novel_file_name = '/console/assets/file/source/' + resource[0].novel_file_name
                                    resource[0].agreement_file_name = '/console/assets/file/uploads/' + resource[0].agreement_file_name
                                    this.novel_data = resource
                                } else {
                                    this.novel_data = ''
                                    alert('查無資料');
                                }
                            }
                        },
                        error => {
                            console.log(error);
                        }
                    )
                }
            },
             novel_type(index) {
                if( this.novel_data[index].novel_type == '1' )
                {
                    return '短篇小說'
                } else {
                    return '中短篇小說'
                }
            },
            save_note(novel_no,index) {
                this.$http.post('http://pansf-upload.panmedia.asia/console/admin/save_note',{novel_no:novel_no, note: this.novel_data[index].note},{emulateJSON: true}).then(success => {
                    alert('儲存成功')
                })
            }
        }
    }
</script>