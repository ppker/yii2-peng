<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/20
 * Project: Cat Visual
 */
$this->title = '用户账号';
$this->params['title_sub'] = '管理用户账号信息';
?>


<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">管理用户账号信息</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn blue btn-outline btn-circle" href="javascript:;" actionrule="add" actionid="">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> 新增用户</span>
                        </a>
                        <a class="btn red btn-outline btn-circle" href="javascript:;" actionrule="delete" actionid="">
                            <i class="fa fa fa-remove"></i>
                            <span class="hidden-xs"> 删除用户</span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn green btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs"> 设置</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="sample_3_tools">
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-printer"></i> Print</a>
                            </li>
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-check"></i> Copy</a>
                            </li>
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-doc"></i> PDF</a>
                            </li>
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-paper-clip"></i> Excel</a>
                            </li>
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-cloud-upload"></i> CSV</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" actionrule="" actionid="" class="tool-action">
                                    <i class="icon-refresh"></i> 刷新</a>
                            </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th> Rendering engine </th>
                            <th> Browser </th>
                            <th> Platform(s) </th>
                            <th> Engine version </th>
                            <th> CSS grade </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> Trident </td>
                            <td> Internet Explorer 4.0 </td>
                            <td> Win 95+ </td>
                            <td> 4 </td>
                            <td> X </td>
                        </tr>
                        <tr>
                            <td> Trident </td>
                            <td> Internet Explorer 5.0 </td>
                            <td> Win 95+ </td>
                            <td> 5 </td>
                            <td> C </td>
                        </tr>
                        <tr>
                            <td> Trident </td>
                            <td> Internet Explorer 5.5 </td>
                            <td> Win 95+ </td>
                            <td> 5.5 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Trident </td>
                            <td> Internet Explorer 6 </td>
                            <td> Win 98+ </td>
                            <td> 6 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Trident </td>
                            <td> Internet Explorer 7 </td>
                            <td> Win XP SP2+ </td>
                            <td> 7 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Trident </td>
                            <td> AOL browser (AOL desktop) </td>
                            <td> Win XP </td>
                            <td> 6 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Firefox 1.0 </td>
                            <td> Win 98+ / OSX.2+ </td>
                            <td> 1.7 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Firefox 1.5 </td>
                            <td> Win 98+ / OSX.2+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Firefox 2.0 </td>
                            <td> Win 98+ / OSX.2+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Firefox 3.0 </td>
                            <td> Win 2k+ / OSX.3+ </td>
                            <td> 1.9 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Camino 1.0 </td>
                            <td> OSX.2+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Camino 1.5 </td>
                            <td> OSX.3+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Netscape 7.2 </td>
                            <td> Win 95+ / Mac OS 8.6-9.2 </td>
                            <td> 1.7 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Netscape Browser 8 </td>
                            <td> Win 98SE+ </td>
                            <td> 1.7 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Netscape Navigator 9 </td>
                            <td> Win 98+ / OSX.2+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.0 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.1 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.1 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.2 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.2 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.3 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.3 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.4 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.4 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.5 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.5 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.6 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> 1.6 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.7 </td>
                            <td> Win 98+ / OSX.1+ </td>
                            <td> 1.7 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Mozilla 1.8 </td>
                            <td> Win 98+ / OSX.1+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Seamonkey 1.1 </td>
                            <td> Win 98+ / OSX.2+ </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Gecko </td>
                            <td> Epiphany 2.20 </td>
                            <td> Gnome </td>
                            <td> 1.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> Safari 1.2 </td>
                            <td> OSX.3 </td>
                            <td> 125.5 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> Safari 1.3 </td>
                            <td> OSX.3 </td>
                            <td> 312.8 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> Safari 2.0 </td>
                            <td> OSX.4+ </td>
                            <td> 419.3 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> Safari 3.0 </td>
                            <td> OSX.4+ </td>
                            <td> 522.1 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> OmniWeb 5.5 </td>
                            <td> OSX.4+ </td>
                            <td> 420 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> iPod Touch / iPhone </td>
                            <td> iPod </td>
                            <td> 420.1 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Webkit </td>
                            <td> S60 </td>
                            <td> S60 </td>
                            <td> 413 </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 7.0 </td>
                            <td> Win 95+ / OSX.1+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 7.5 </td>
                            <td> Win 95+ / OSX.2+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 8.0 </td>
                            <td> Win 95+ / OSX.2+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 8.5 </td>
                            <td> Win 95+ / OSX.2+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 9.0 </td>
                            <td> Win 95+ / OSX.3+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 9.2 </td>
                            <td> Win 88+ / OSX.3+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera 9.5 </td>
                            <td> Win 88+ / OSX.3+ </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Opera for Wii </td>
                            <td> Wii </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Nokia N800 </td>
                            <td> N800 </td>
                            <td> - </td>
                            <td> A </td>
                        </tr>
                        <tr>
                            <td> Presto </td>
                            <td> Nintendo DS browser </td>
                            <td> Nintendo DS </td>
                            <td> 8.5 </td>
                            <td> C/A
                                <sup>1</sup>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
