<template>
  <view class="search-page">
    <u-search
      v-model="keyword"
      placeholder="输入球馆名称"
      height="80"
      :show-action="false"
      @confirm="onConfirmSearch"
    />

    <view class="section">
      <view class="title">我是会员</view>
      <view class="tags">
        <u-tag
          v-for="(item, index) in memberGyms"
          :key="index"
          :text="item"
          mode="light"
          :color="themeColor"
          :border-color="themeColor"
          custom-class="tag"
          @click="selectTag(item)"
        />
      </view>
    </view>

    <view class="section history" v-if="historyList.length">
      <view class="history-header">
        <view class="title">历史记录</view>
        <u-icon
          name="trash"
          size="18"
          class="clear"
          @click="clearHistory"
        />
      </view>
      <view class="tags">
        <u-tag
          v-for="(item, index) in historyList"
          :key="index"
          :text="item"
          mode="light"
          color="#C0C4CC"
          border-color="#C0C4CC"
          custom-class="tag"
          @click="selectTag(item)"
        />
      </view>
    </view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      themeColor: '#1FCF76',
      keyword: '',
      memberGyms: ['羽协球馆', '体育中心', '市民广场'],
      historyList: [],
    };
  },
  onLoad() {
    const list = uni.getStorageSync('historyList') || [];
    this.historyList = list;
  },
  methods: {
    onConfirmSearch() {
      if (!this.keyword) return;
      // 更新历史
      const arr = this.historyList.filter(h => h !== this.keyword);
      arr.unshift(this.keyword);
      if (arr.length > 10) arr.pop();
      this.historyList = arr;
      uni.setStorageSync('historyList', arr);
      this.gotoResult(this.keyword);
    },
    selectTag(name) {
      this.keyword = name;
      this.onConfirmSearch();
    },
    gotoResult(kw) {
      uni.navigateTo({
        url: `/pages/user/search/result?keyword=${kw}`,
      });
    },
    clearHistory() {
      uni.showModal({
        title: '提示',
        content: '确定清空历史记录吗？',
        success: res => {
          if (res.confirm) {
            this.historyList = [];
            uni.removeStorageSync('historyList');
          }
        },
      });
    },
  },
};
</script>

<style scoped>
.search-page {
  background: #f5f5f5;
  min-height: 100vh;
  padding: 24rpx;
}
.section {
  margin-top: 20rpx;
}
.history {
  margin-top: 40rpx;
}
.title {
  font-size: 28rpx;
  font-weight: 600;
  color: #202020;
  margin-bottom: 20rpx;
}
.tags {
  display: flex;
  flex-wrap: wrap;
}
.tag {
  margin-right: 20rpx;
  margin-bottom: 20rpx;
  padding: 0 20rpx;
  height: 56rpx;
  line-height: 56rpx;
  font-size: 24rpx;
}
.history-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.clear {
  color: #606266;
}
</style>
