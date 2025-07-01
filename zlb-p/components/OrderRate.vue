<template>
  <u-popup :show="show" mode="center" :round="16" @close="close">
    <view class="popup">
      <u-icon name="close" class="close" size="20" @click="close" />
      <view class="title">综合评分</view>
      <u-rate v-model="score" active-color="#FFC107" />
      <view class="title">综合评价</view>
      <u--textarea v-model="content" placeholder="请输入内容" height="200" border="1" border-color="#EBEEF5" radius="8" />
      <u-button type="primary" shape="circle" class="btn" @click="submit">确定</u-button>
    </view>
  </u-popup>
</template>

<script>
export default {
  data() {
    return {
      show: false,
      orderId: null,
      score: 0,
      content: '',
    };
  },
  methods: {
    open(id) {
      this.orderId = id;
      this.show = true;
    },
    close() {
      this.show = false;
      this.score = 0;
      this.content = '';
    },
    submit() {
      if (this.score <= 0) return uni.$u.toast('请评分');
      this.$emit('submit', {
        orderId: this.orderId,
        score: this.score,
        content: this.content,
      });
      this.close();
    },
  },
};
</script>

<style scoped>
.popup {
  padding: 40rpx 20rpx 60rpx;
  text-align: center;
  position: relative;
}
.close {
  position: absolute;
  top: 20rpx;
  right: 20rpx;
}
.title {
  font-size: 26rpx;
  font-weight: 600;
  margin: 20rpx 0;
}
.btn {
  width: 80%;
  margin-top: 40rpx;
}
</style>
