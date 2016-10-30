        <?php include APPPATH . 'views/common/header_right.php'?>
        <footer class="footer">
            <div class="footer-inner">
                <ul class="footer-yy clearfix">
                    <li><span class="footer-yy-ico1"></span>百分百正品行货</li>
                    <li><span class="footer-yy-ico2"></span>7天无理由退货</li>
                    <li><span class="footer-yy-ico3"></span>严格准入标准</li>
                    <li><span class="footer-yy-ico4"></span>品牌授权</li>
                    <li><span class="footer-yy-ico5"></span>权威荣誉</li>
                </ul>
                <div class="copyright">
                    <div class="copyright-wz fl">
                        <p>Copyright © 2014-2016 yueyawang.com，All Rights Reserved 沪ICP备12046295号-2 互联网药品交易服务资格证：沪B20140002 </p>
                        <div class="about-copyright">
                            <a target="_blank" href="/about_us/about_us">关于悦牙网</a>
                            <a target="_blank" href="/about_us/service">服务条款</a>
                            <a target="_blank" href="/about_us/feedback">意见反馈</a>
                            <a target="_blank" href="/about_us/sales_policy">售后政策</a>
                            <a target="_blank" href="/about_us/team_work">合作咨询</a>
                            <a target="_blank" href="http://jobs.51job.com/all/co2393685.html">加入我们</a>
                        </div>
                        <p class="copy-mc">上海欧思蔚奥医疗器材有限公司</p>
                    </div>
                    <ul class="copyright-pic">
                        <li><img src="<?php echo static_style_url('new_pc/images/weixin.jpg?v=version');?>" width="81" height="81" alt="悦牙网官方微信"/><p>官方微信</p></li>
                        <li><img src="<?php echo static_style_url('new_pc/images/mobie.jpg?v=version');?>" width="81" height="81" alt="悦牙网官方移动端"/><p>官方移动端</p></li>  
                    </ul>
                </div>
            </div>
        </footer>
    </body>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/jquery-3.0.0.min.js?v=version');?>"></script>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/loading.js?v=version');?>"></script>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/jquery.lazyload.min.js?v=version');?>"></script>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/quick_links.js?v=version');?>"></script>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/funParabola_right.js?v=version');?>"></script>
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/parabola.js?v=version');?>"></script>  
    <script type="text/javascript">
        var user_advar = "<?php echo static_style_url('mobile/touxiang/');?>";
    </script>  
    <script type="text/javascript" src="<?php echo static_style_url('new_pc/js/common.js?v=version');?>"></script>

    <script>
        jQuery(document).ready(function ($) {

            //首页menu当前状态问题
            if(typeof sessionStorage != 'undefined') {
                $('.meun_list_left li').click(function(){
                sessionStorage.setItem('activeMainMenuItem', $(this).index());
                });
                var activeMainMenuItem = sessionStorage.getItem('activeMainMenuItem');
                
                $('.meun_list_left li a').removeClass('active');
                $('.meun_list_left li').eq(!activeMainMenuItem ? 0 : activeMainMenuItem).find('a').addClass('active');    
            }
            
            //调用美洽客服
            if(typeof _MEIQIA != 'undefined') {
                var isShowMeiqia = 0;

                $('.mpbtn_recharge, .add_cart_jl .xunjia').click(function(){
                    isShowMeiqia += 1;
                    if(isShowMeiqia % 2) {
                        if(isShowMeiqia == 1) _MEIQIA('init');
                        _MEIQIA._SHOWPANEL();
                    } else {
                        _MEIQIA._HIDEPANEL();
                    }
                });    
            }            

            //图片牙齿加载
            $("img.lazy").lazyload({
                placeholder: "data:image/jpg;base64,R0lGODlh5gDmAIABAObm5gAAACH/C05FVFNDQVBFMi4wAwEAAAAh/wtYTVAgRGF0YVhNUDw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTMyIDc5LjE1OTI4NCwgMjAxNi8wNC8xOS0xMzoxMzo0MCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUuNSAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDMzNjNDOEI5MDNCMTFFNkEyM0FBRTBEREEwMjg3QkMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDMzNjNDOEM5MDNCMTFFNkEyM0FBRTBEREEwMjg3QkMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowMzM2M0M4OTkwM0IxMUU2QTIzQUFFMEREQTAyODdCQyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDowMzM2M0M4QTkwM0IxMUU2QTIzQUFFMEREQTAyODdCQyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PgH//v38+/r5+Pf29fTz8vHw7+7t7Ovq6ejn5uXk4+Lh4N/e3dzb2tnY19bV1NPS0dDPzs3My8rJyMfGxcTDwsHAv769vLu6ubi3trW0s7KxsK+urayrqqmop6alpKOioaCfnp2cm5qZmJeWlZSTkpGQj46NjIuKiYiHhoWEg4KBgH9+fXx7enl4d3Z1dHNycXBvbm1sa2ppaGdmZWRjYmFgX15dXFtaWVhXVlVUU1JRUE9OTUxLSklIR0ZFRENCQUA/Pj08Ozo5ODc2NTQzMjEwLy4tLCsqKSgnJiUkIyIhIB8eHRwbGhkYFxYVFBMSERAPDg0MCwoJCAcGBQQDAgEAACH5BAUUAAEALAAAAADmAOYAAAL/jI+py+0Po5y02ouz3rz7D4biSJbmiabqyrbuC8fyTNf2jef6zvf+DwwKh8Si8YhMKpfMpvMJjUqn1Kr1is1qt9yu9wsOi8fksvmMTqvX7Lb7DY/L5/S6/Y7P6/f8vv8PGCg4SFhoeIiYqLjI2Oj4CBkpOUlZaXmJmam5ydnp+QkaKjpKWmp6ipqqusra6voKGys7S1tre4ubq7vL2+v7CxwsPExcbHyMnKy8zNzs/AwdLT1NXW19jZ2tvQHQ3b3t4P0NziAOQF4ujr5gvq7Q7o4AH28wT28fj++uv86P7k8OIDiB2whqM5gNITaF1xhac1gNIjWJ0yhKsxgNIzSNbM84OvPYDCQzb/RKmjyJMqXKlSxbunwJM6bMmTRr2ryJM6fOnTx7+vwJNKjQoUSLGj2KNKnSpUybOn0KNarUqVSrWr2KNavWrVy7ev0KNqzYsWTLmj2LNq3atWzbun0LN67cuXTr2r2LNy+9AgAh+QQFFAABACwcAGQABQAfAAACC4yPqcvtD6OctJoCACH5BAUUAAEALBwAWwA0ADIAAAKojG+gi7ivmoRPHmoptEmzvE1exI2kWKEjaJahirkeF8T0jeddqvf+/vkJcbah8FU0+pAv5ZKXdOaYPKmOGrROoU3tDavxyk4mgJhFbp0b4O66xp29HfHsnB6M3uF59769B3PhdwcYiJdWdWh4CGTm+NjIl2gXyNh4uVh3grkZ2dmnaOkp6Tgo+kdamjn6OclZykYYqxf76moLmQuDm1tLO7saLDksvFsAACH5BAUUAAEALDAAZAAgACkAAAJtjIGpy2zXolRw2hiudrujvDziSIIUVaZkiKqu+bVvyiazW383fdp7mQP8gD3dUBQUHis2TwfmnECjmClVdm0Qs7PQkuf7jrzisazMVKIf5DXUzQ6722t62S52zPFLbV2P5vd3die3pwYHkihSAAAh+QQFFAABACxEAHsAJQASAAACQQyCqcvdAJ2cC1qKZby5o2hwHiVax6iBn4hWbPiiJmOq8kzXN/7UJ+mb+HiJYSxnTOoyyuav4xy2YNGpompFEikFACH5BAUUAAEALFsAWwAzADIAAAKihI+pyw0BoZu0RlmzPjfsb13g2HTmiaZnorbuy77yHMX03domgs969+uhgjWeMGdcJY/DJdDJfHKa06iyuoNaMVipYXv9UsVgkZZLLqMfY7Z6nSJu5Z6zlU6P4vPHPenPUAc4yEFoyHYI6JWo8daW5ojUFanCR1k0eRnmphln1wkH6pkpGlqaRVpqqbl62Ur56qhwugip9sG6kZsByitK8VIAACH5BAUUAAEALJQAWwA1ADIAAAKChI+py40Bg5u0JmizXnL7D4ZaRJbmiaJTyrbu6sYy5sx2C996me9+79MBg7YhUWY8vmrKW7KZekJP0imPaV02srEqt7P9srxcctZsRU/VUHbTrYQf5UR60P7Diqn6/TXsZ4K3MyjUF0gDiBhR6HSI2Fj0GBg5U4k0ScmwqKLAGWVQAAAh+QQFFAABACycAGgAEQAXAAACK4wPmcet2+IDUb7qLkZ6h+kZoDWV5omm6sq2HaeE34uNnr3hNV3pPU+iRAoAIfkEBWQAAQAssABuABEAFwAAAiuMD5nHrdviA1G+6i5GeofpGaA3QVyJpurKti6addtIyhg92xV+65YS+ugKADs=",
                effect: "fadeIn",
                threshold:200
            });
            
            update_cart_num();
        });
    </script>

    <?php include_once(APPPATH . "views/common/tongji.php");?>
    <?php include APPPATH . 'views/common/meiqia.php'?>
</html>

