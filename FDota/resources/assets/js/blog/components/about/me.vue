<template>
    <div>
        <div class="jumbotron text-center"></div>
        <p class="avatar text-center">
            <img src="/images/default_avatar.png" alt="" class="img-avatar img-circle">
        </p>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"># whoami</div>
                <div class="panel-body">
                    <ul class="desc list-unstyled">
                        <li>
                            <span class="dt">Level</span>
                            <span class="dd"><small>一拳程序员 ?</small></span>
                        </li>
                        <li>
                            <span class="dt">Desc</span>
                            <span class="dd"><small>吃饭睡觉敲代码 敲完代码打刀塔</small></span>
                        </li>
                        <li>
                            <span class="dt">Status</span>
                            <span class="dd"><small>无业游民</small></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created () {
        }
    }
</script>

<style scoped>
    .jumbotron {
        background: transparent;
        margin: 0 20px;
    }

    .avatar {
        margin-bottom: 20px;
    }

    .img-avatar {
        width: 60px;
    }

    .desc li {
        float: left;
        list-style: none;
        margin-right: 10px;
        margin-bottom: 20px;
        height: 43px;
        border: 1px solid #ECF0F1;
        overflow: hidden;
    }

    .dt {
        padding: 0 15px;
        line-height: 43px;
        font-size: 16px;
        color: #9b9b9b;
        font-weight: 400;
        font-style: normal;
    }

    .dd {
        padding: 15px;
        line-height: 42px;
        color: #34495E;
        font-weight: 400;
        background: #ECF0F1;
        border-left: 1px solid #ECF0F1;
    }
</style>