<template>
  <view class="page">
    <view class="gap"></view>
    <u-cell-group>
      <u-cell title="账号" :value="account" :border="false" />
      <u-cell title="绑定微信号" :value="wechat" />
      <u-cell title="旧登录密码" :border="false">
        <template #value>
          <u-input v-model="form.oldPwd" type="password" placeholder="必填" border="none" />
        </template>
      </u-cell>
      <u-cell title="新登录密码">
        <template #value>
          <u-input v-model="form.newPwd" type="password" placeholder="必填" border="none" />
        </template>
      </u-cell>
      <u-cell title="确定登录密码">
        <template #value>
          <u-input v-model="form.confirmPwd" type="password" placeholder="必填" border="none" />
        </template>
      </u-cell>
    </u-cell-group>
    <view class="tip">密码必须是 8-16 位英文、数字、字符组合</view>
    <view class="footer">
      <u-link :href="''" @click="forgetPwd" text="忘记密码？" :color="themeColor" />
    </view>
    <view class="btn">
      <u-button type="primary" shape="circle" @click="save">保存</u-button>
    </view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      themeColor: '#1FCF76',
      account: 'user@example.com',
      wechat: '未绑定',
      form: {
        oldPwd: '',
        newPwd: '',
        confirmPwd: ''
      }
    }
  },
  methods: {
    forgetPwd() {
      // TODO: 忘记密码逻辑
    },
    save() {
      if (!this.form.oldPwd || !this.form.newPwd || !this.form.confirmPwd) {
        uni.showToast({ title: '请填写完整', icon: 'none' })
        return
      }
      if (this.form.newPwd !== this.form.confirmPwd) {
        uni.showToast({ title: '两次密码不一致', icon: 'none' })
        return
      }
      const reg = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,16}$/
      if (!reg.test(this.form.newPwd)) {
        uni.showToast({ title: '密码格式不正确', icon: 'none' })
        return
      }
      // TODO: 提交接口
      uni.showToast({ title: '已保存', icon: 'none' })
    }
  }
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
.tip {
  font-size: 22rpx;
  color: #909399;
  margin: 20rpx 0;
}
.footer {
  text-align: right;
  margin-bottom: 20rpx;
}
.btn {
  text-align: center;
}
</style>
