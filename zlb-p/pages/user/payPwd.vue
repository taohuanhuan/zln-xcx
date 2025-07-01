<template>
  <view class="page">
    <view class="title">请设置支付密码</view>
    <u-code-input v-model="pwd" mode="box" maxlength="6" @finish="onComplete" />
    <u-number-keyboard :show="true" @change="onKey" :custom-style="keyboardStyle">
      <template #delete-icon>
        <u-icon name="close" size="24" />
      </template>
    </u-number-keyboard>
  </view>
</template>

<script>
export default {
  data() {
    return {
      themeColor: '#1FCF76',
      pwd: '',
      keyboardStyle: 'position:fixed;bottom:0;left:0;width:100%;'
    }
  },
  methods: {
    onKey(val) {
      if (val === 'delete') {
        this.pwd = this.pwd.slice(0, -1)
      } else {
        if (this.pwd.length < 6) this.pwd += val
        if (this.pwd.length === 6) this.onComplete(this.pwd)
      }
    },
    onComplete(val) {
      // TODO: setPayPwd
      uni.showToast({ title: '设置成功', icon: 'none' })
      setTimeout(() => {
        uni.navigateBack()
      }, 500)
    }
  }
}
</script>

<style scoped>
.page {
  background: #F5F5F5;
  min-height: 100vh;
  padding: 24rpx;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.title {
  font-size: 30rpx;
  font-weight: 600;
  margin-top: 60rpx;
  margin-bottom: 40rpx;
}
</style>
