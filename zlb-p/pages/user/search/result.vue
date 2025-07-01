<template>
  <view class="result-page">
    <u-search
      v-model="keyword"
      placeholder="输入球馆名称"
      height="80"
      :show-action="false"
      @confirm="onConfirmSearch"
    />

    <scroll-view
      class="list"
      scroll-y
      refresher-enabled
      :refresher-triggered="isRefreshing"
      @refresherrefresh="onRefresh"
      @scrolltolower="onLoadMore"
    >
      <view v-for="(item, index) in gymList" :key="index" class="card" @click="goDetail(item)">
        <image :src="item.image" class="img" mode="aspectFill" />
        <view class="info">
          <view class="top">
            <text class="name">{{ item.name }}</text>
            <text class="rating">{{ item.rating }}分</text>
          </view>
          <view class="tag-row">
            <u-tag
              v-for="(tag, i) in item.tags"
              :key="i"
              :text="tag"
              plain
              size="mini"
              custom-class="tag"
            />
          </view>
          <view class="distance">{{ item.distance }}</view>
        </view>
      </view>
      <u-empty v-if="!gymList.length && loadStatus !== 'loading'" mode="list" text="暂无数据" />
      <u-loadmore :status="loadStatus" />
    </scroll-view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      themeColor: '#1FCF76',
      keyword: '',
      gymList: [],
      page: 1,
      pageSize: 10,
      loadStatus: 'loadmore',
      isRefreshing: false,
    };
  },
  onLoad(query) {
    this.keyword = query.keyword || '';
    this.fetchList(true);
  },
  methods: {
    onConfirmSearch() {
      if (!this.keyword) return;
      // 更新历史
      let history = uni.getStorageSync('historyList') || [];
      history = history.filter(h => h !== this.keyword);
      history.unshift(this.keyword);
      if (history.length > 10) history.pop();
      uni.setStorageSync('historyList', history);
      this.fetchList(true);
    },
    onRefresh() {
      this.isRefreshing = true;
      this.fetchList(true);
    },
    onLoadMore() {
      this.fetchList();
    },
    fetchList(reset = false) {
      if (reset) {
        this.page = 1;
        this.gymList = [];
      }
      this.loadStatus = 'loading';

      // 模拟异步请求
      setTimeout(() => {
        const list = Array.from({ length: this.pageSize }, (_, i) => {
          const idx = (this.page - 1) * this.pageSize + i + 1;
          return {
            name: `${this.keyword}场馆${idx}`,
            rating: '4.7',
            image: 'https://via.placeholder.com/140',
            tags: ['好停车', '可拉线', '有空调', '可洗澡'],
            distance: `${(Math.random() * 10).toFixed(1)}km`,
          };
        });

        this.gymList = this.gymList.concat(list);
        this.page++;
        this.loadStatus = this.page > 2 ? 'nomore' : 'loadmore';
        this.isRefreshing = false;
      }, 500);
    },
    goDetail(item) {
      // TODO: 跳转到场馆详情页
    },
  },
};
</script>

<style scoped>
.result-page {
  background: #f5f5f5;
  min-height: 100vh;
  padding: 24rpx;
}
.list {
  margin-top: 20rpx;
  height: calc(100vh - 104rpx);
}
.card {
  display: flex;
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2rpx 8rpx rgba(0, 0, 0, 0.05);
  padding: 24rpx;
  margin-bottom: 20rpx;
}
.img {
  width: 140rpx;
  height: 140rpx;
  border-radius: 8px;
  margin-right: 20rpx;
}
.info {
  flex: 1;
  position: relative;
}
.top {
  display: flex;
  justify-content: space-between;
}
.name {
  font-size: 28rpx;
  font-weight: 600;
  color: #202020;
  max-width: 360rpx;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.rating {
  font-size: 26rpx;
  color: #1FCF76;
}
.tag-row {
  display: flex;
  flex-wrap: wrap;
  margin-top: 20rpx;
}
.tag {
  margin-right: 10rpx;
  margin-bottom: 10rpx;
  font-size: 22rpx;
  line-height: 32rpx;
  color: #606266;
  border-color: #C0C4CC;
}
.distance {
  position: absolute;
  right: 0;
  bottom: 0;
  color: #909399;
  font-size: 22rpx;
}
</style>
