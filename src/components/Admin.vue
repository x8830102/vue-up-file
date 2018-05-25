<template>
    <div class="container-fluid">
        <div class="row p-4 m-0"><img src="dist/image/panscifi_logo.png"></div>
        <div class="row p-2"></div>
        <div class="row p-4 m-0"><h3>參賽稿件管理</h3></div>
        <div class="row p-4 m-0">
            <div class="col-12">
                <form @submit.prevent="submit">
                    <input type="text" name="key" placeholder="請輸入關鍵字或投稿編號">
                    <select name="novel_type" id="" class="ml-5" placeholder="請選擇投稿獎項">
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
                        <td>{{ item.novel_type }}</td>
                        <td>{{ (item.novel_file_size /1024/1024).toFixed(1) }} MB</td>
                        <td><a :href="item.novel_file_name" download  class="btn btn-primary">下載</a></td>
                        <td><a :href="item.agreement_file_name" download class="btn btn-primary">下載</a></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <nav aria-label="search result ">
          <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item" v-for=""><a class="page-link" href="#"></a></li>>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'Admin',
        data () {
            return {
                all_total: '100',
                short_total: '',
                novella_total: '',
                novel_data: {},
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

            this.$http.post('http://pansf-upload.panmedia.asia/console/novel/admin_all','',{emulateJSON: true}).then( success => {

                const resource = success.data.data
                if( resource != '' ) {
                    resource[0].novel_file_name = '/console/assets/file/source/' + resource[0].novel_file_name
                    resource[0].agreement_file_name = '/console/assets/file/uploads/' + resource[0].agreement_file_name
                    this.novel_data = resource
                }
                
            },error => {
                console.log(error);
            })
        },
        methods:{
            submit(e) {
                const formData = new FormData(e.target)
                this.$http.post('http://pansf-upload.panmedia.asia/console/novel/search', formData,{emulateJSON: true}).then(
                    success => {
                        const resource = success.data.data
                        if( resource != '' ) {
                            resource[0].novel_file_name = '/console/assets/file/source/' + resource[0].novel_file_name
                            resource[0].agreement_file_name = '/console/assets/file/uploads/' + resource[0].agreement_file_name
                            this.novel_data = resource
                        }
                        
                    },
                    error => {
                        console.log(error);
                    }
                )
            }
        }
    }
</script>