<template>
  <view class="page">
    <view class="gap"></view>
    <u-cell-group>
      <u-cell title="个人信息管理" is-link url="/pages/user/personal" right-icon-style="color:#C0C4CC" />
      <u-cell title="账号密码管理" is-link url="/pages/user/account" right-icon-style="color:#C0C4CC" />
      <u-cell title="支付密码管理" is-link url="/pages/user/payPwd" right-icon-style="color:#C0C4CC" />
    </u-cell-group>
    <view class="gap"></view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      themeColor: '#1FCF76',
    }
  },
}
</script>

<style scoped>
.page {
  background: #F5F5F5;
  min-height: 100vh;
  padding: 24rpx;
}
.gap {
  height: 20rpx;
}
</style>
