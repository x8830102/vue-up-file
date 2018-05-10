<template>
    <div>
        <div class="modal" id="short">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">
                    <b>投稿獎項｜短篇小說</b>
                  </h3>
                  <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                  </button>
                </div>
                <div class="card-block p-5">
                  <label for="exampleInputEmail1" class="text-dark">
                    <b>
                      <b>上傳作品</b>
                    </b> (檔案大小不得超過 10 MB)</label>
                  <input type="file" class="form-control-file text-dark" id="short_myfile" required="required">
                  <hr>
                  <b>
                    <label for="exampleInputEmail1" class="text-dark">
                      <b>
                        <b>上傳著作權同意書</b>
                      </b>
                    </label>
                    <input type="file" class="form-control-file text-dark" id="short_agreement" required="required">
                    <div class="form-check mt-2 text-dark py-3">
                      <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                      <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                        <a href="http://pansf.panmedia.asia/3" target="_blank">稿件注意事項</a>&nbsp;與同獎項不得重複投稿規則。</label>
                    </div>
                  </b>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary">確認上傳</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="novella">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">
                    <b>投稿獎項｜中短篇小說</b>
                  </h3>
                  <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                  </button>
                </div>
                <div class="card-block p-5">
                  <label for="exampleInputEmail1" class="text-dark">
                    <b>
                      <b>上傳作品</b>
                    </b> (檔案大小不得超過 10 MB)</label>
                  <input type="file" class="form-control-file text-dark" id="novella_myfile" required="required">
                  <hr>
                  <b>
                    <label for="exampleInputEmail1" class="text-dark">
                      <b>
                        <b>上傳著作權同意書</b>
                      </b>
                    </label>
                    <input type="file" class="form-control-file text-dark" id="novella_agreement" required="required">
                    <div class="form-check mt-2 text-dark py-3">
                      <input class="form-check-input" type="checkbox" id="exampleCheck1" value="on" required="required">
                      <label class="form-check-label text-danger" for="exampleCheck1">我已閱讀並同意此
                        <a href="http://pansf.panmedia.asia/3" target="_blank">稿件注意事項</a>&nbsp;與同獎項不得重複投稿規則。</label>
                    </div>
                  </b>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary">確認上傳</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal" id="upload_alert">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-danger">
                    <b>請注意</b>
                  </h3>
                  <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>請先完成個人資料填寫，方能上傳作品。</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary">前往填寫個人資料</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
                </div>
              </div>
            </div>
          </div>
          <div class="py-5">
            <div class="container">
              <div class="row">
                <div class="col-md-12 w-100">
                  <img class="img-fluid d-block mx-auto" src="pansf_logo.png" width="333px" height="100px"> </div>
              </div>
            </div>
          </div>
          <nav class="navbar navbar-expand-md sticky-top navbar-light bg-light">
            <div class="container">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse text-center justify-content-center" id="navbar2SupportedContent">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/">首頁</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/2">徵文啟事</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/3">投稿注意事項</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/4">徵文與活動報名</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pansf_upload.html">作品上傳</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/5">合作夥伴</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://pansf.panmedia.asia/6">聯繫總部</a>
                  </li>
                </ul>
                <div class="btn-group">
                  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> abcc &nbsp;
                    <i class="fa d-inline fa-lg fa-user-circle-o"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="myfile.html">個人資料</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">登出</a>
                  </div>
                </div>
              </div>
            </div>
          </nav>
          <div class="p-0">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="p-0 m-5"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="p-0">
            <div class="container">
              <div class="row"> </div>
            </div>
          </div>
          <div class="w-100">
            <div class="container">
              <div class="row">
                <div class="col-md-8        offset-md-2">
                  <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="icon_1_.png" width="45px" height="45px">
                  <a class="btn btn-outline-secondary d-inline-flex" href="myfile.html">個人資料</a>
                  <img class="img-fluid d-block rounded-circle d-inline-flex m-0 p-0" src="icon_2_active.png" width="45px" height="45px">
                  <a href="#" class="btn btn-outline-secondary d-inline-flex active">作品上傳 </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <hr> </div>
              </div>
            </div>
          </div>
          <div class="">
            <div class="container">
              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <ul class="list-group">
                    <table class="table">
                      <thead>
                        <tr></tr>
                      </thead>
                      <tbody>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>
                      </tbody>
                    </table>
                    <hr>
                    <h4 class="text-secondary p-3">
                      <b>
                        <strong>作品上傳</strong>
                      </b>
                      <br> </h4>
                    <p class="m-0 p-5">兩種獎項可同時參加，各以投稿一篇為限，同一篇稿件不得重複上傳，上傳作品檔案前，請謹慎確認。也請注意上傳的檔案格式：
                      <br>1. 上傳作品 (上傳 docx 檔，檔案大小不得超過 10 MB)&nbsp;
                      <br>2. 上傳已簽署之著作權同意書 (上傳 pdf 或 jpg,png,tif 等圖片檔，
                      <a href="#">同意書下載連結</a>)</p>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <table class="table text-center">
                          <thead class="text-center">
                            <tr class="text-center">
                              <th class="table-secondary text-center p-5">
                                <span style="font-weight: normal;">投稿獎項</span>
                              </th>
                              <th class="table-secondary text-center">短篇小說
                                <br>
                                <span style="font-weight: normal;">3,000 到 6,000 字</span>
                              </th>
                              <th class="text-center table-secondary">中短篇小說
                                <br>
                                <span style="font-weight: normal;">9,000 到 12,000 字</span>
                              </th>
                            </tr>
                            <tr class="text-center"></tr>
                            <tr class="text-center">
                              <td class="table-secondary text-center">目前投稿人數</td>
                              <td class="table-secondary text-center" contenteditable="true">300</td>
                              <td class="table-secondary text-center">100</td>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            <tr>
                              <td class="bg-light text-center">上傳時間</td>
                              <td class="text-center">2018-06-06 21:32</td>
                              <td class="text-info text-center">N/A</td>
                            </tr>
                            <tr>
                              <td class="bg-light text-center">投稿編號</td>
                              <td class="text-center">A1234</td>
                              <td class="text-info text-center">N/A</td>
                            </tr>
                            <tr>
                              <td class="bg-light text-center">投稿作品</td>
                              <td class="text-center">
                                <i class="fa fa-check fa-lg text-primary"></i> 10 MB</td>
                              <td class="text-info text-center">N/A</td>
                            </tr>
                            <tr>
                              <td class="bg-light text-center">著作版權同意書</td>
                              <td class="text-center">
                                <i class="fa fa-check fa-lg text-primary"></i>
                              </td>
                              <td class="text-info text-center">N/A</td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                            <tr>
                              <td></td>
                              <td class="">
                                <p>
                                  <a href="#" class="btn btn-outline-info disabled">完成上傳</a>
                                </p>
                              </td>
                              <td>
                                <p>
                                  <a class="btn navbar-btn ml-2 text-white btn-secondary" data-target="#novella" data-toggle="modal">前往上傳 </a>
                                </p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <table class="table"></table>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="p-5"></div>
          <div class="px-0">
            <div class="container"> </div>
          </div>
    </div>
</template>

<script>
    export default{
        name: 'Vote'
    }
</script>