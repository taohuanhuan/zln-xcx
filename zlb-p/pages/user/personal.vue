<template>
  <view class="page">
    <view class="gap"></view>
    <u-cell-group>
      <u-cell title="头像" is-link :border="false" right-icon-style="color:#C0C4CC" @click="chooseAvatar">
        <template #value>
          <image :src="avatar" class="avatar" />
        </template>
      </u-cell>
    </u-cell-group>
    <view class="gap"></view>
    <u-cell-group>
      <u-cell title="昵称" :border="false">
        <template #value>
          <u-input v-model="form.nickname" placeholder="请输入" border="none" />
        </template>
      </u-cell>
      <u-cell title="性别" is-link :value="form.gender" right-icon-style="color:#C0C4CC" @click="showGender=true" />
      <u-cell title="水平" is-link :value="form.level" right-icon-style="color:#C0C4CC" @click="showLevel=true" />
    </u-cell-group>
    <view class="save-btn">
      <u-button type="primary" shape="circle" @click="save">保存</u-button>
    </view>
    <u-picker :show="showGender" :columns="[genders]" @confirm="onGenderConfirm" @cancel="showGender=false" />
    <u-picker :show="showLevel" :columns="[levels]" @confirm="onLevelConfirm" @cancel="showLevel=false" />
  </view>
</template>

<script>
export default {
  data() {
    return {
      avatar: 'https://via.placeholder.com/80',
      form: {
        nickname: '',
        gender: '保密',
        level: '初级'
      },
      genders: ['男', '女', '保密'],
      levels: ['初级', '中级', '高级'],
      showGender: false,
      showLevel: false,
    }
  },
  methods: {
    chooseAvatar() {
      uni.chooseImage({ count: 1, success: res => { this.avatar = res.tempFilePaths[0] } })
    },
    onGenderConfirm(e) {
      this.form.gender = e.value[0]
      this.showGender = false
    },
    onLevelConfirm(e) {
      this.form.level = e.value[0]
      this.showLevel = false
    },
    save() {
      // TODO: 保存接口
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
.avatar {
  width: 80rpx;
  height: 80rpx;
  border-radius: 50%;
}
.save-btn {
  margin-top: 40rpx;
  text-align: center;
}
</style>
