<template>
  <view class="profile-page">
    <view class="header">
      <image :src="user.avatar" class="avatar" mode="aspectFill"></image>
      <view class="openid">openid: {{ user.openid }}</view>
    </view>
    <view class="section">
      <view class="section-title">已领取徽章</view>
      <view class="badge-list">
        <view class="badge-item" v-for="b in badges" :key="b.id">
          <image :src="b.icon" class="badge-icon" mode="aspectFit"></image>
          <text class="badge-name">{{ b.name }}</text>
        </view>
        <view v-if="badges.length===0" class="empty">暂无徽章</view>
      </view>
    </view>
    <view class="action">
      <u-button type="primary" color="#BB4FE1" @click="goBadgeList">查看所有徽章</u-button>
    </view>
  </view>
</template>

<script>
import { getMyBadges } from '@/config/api'
export default {
  data() {
    return {
      user: {},
      badges: []
    }
  },
  onShow() {
    const info = uni.getStorageSync('userinfo') || {}
    this.user = info.user || {}
    this.loadBadges()
  },
  methods: {
    async loadBadges() {
      try {
        const res = await getMyBadges()
        this.badges = res.data || []
      } catch (e) {
        console.log('load badge fail', e)
      }
    },
    goBadgeList() {
      uni.navigateTo({ url: '/pages/badges/badges' })
    }
  }
}
</script>

<style scoped>
.profile-page {
  min-height: 100vh;
  background: #fdfbfb;
}
.header {
  background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
  padding: 60rpx 0;
  text-align: center;
  color: #fff;
}
.avatar {
  width: 120rpx;
  height: 120rpx;
  border-radius: 60rpx;
  margin-bottom: 20rpx;
  border: 4rpx solid #fff;
}
.section {
  padding: 40rpx 30rpx;
}
.section-title {
  font-size: 32rpx;
  margin-bottom: 20rpx;
}
.badge-list {
  display: flex;
  flex-wrap: wrap;
}
.badge-item {
  width: 33%;
  text-align: center;
  margin-bottom: 40rpx;
}
.badge-icon {
  width: 100rpx;
  height: 100rpx;
}
.action {
  padding: 40rpx;
}
.empty {
  color: #999;
}
</style>
