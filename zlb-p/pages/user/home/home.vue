<template>
        <view class="home-page">
                <u-navbar placeholder :border-bottom="false">
                        <view slot="left" class="city" @click="changeCity">
                                <text>{{ city }}</text>
                                <u-icon name="arrow-down" size="14" color="#202020" style="margin-left:4rpx" />
                        </view>
                        <view slot="center" class="search" @click="goSearch">
                                <u-search placeholder="输入球馆名称" disabled></u-search>
                        </view>
                        <view slot="right" class="nav-icons">
                                <u-icon name="calendar" size="22" :color="themeColor" @click="goBooking" />
                                <u-icon name="map" size="22" color="#606266" style="margin-left:16rpx" @click="locate" />
                        </view>
                </u-navbar>

                <view class="banner">
                        <u-swiper :list="banners" height="200" radius="8" />
                </view>

                <view class="tabs">
                        <u-tabs :list="tabList" :current="currentTab" line-width="40" line-color="#1FCF76" active-color="#1FCF76" inactive-color="#606266" @click="onTabChange" />
                </view>

                <view class="filter-row">
                        <u-row>
                                <u-col span="4" class="filter-item" @click="openDistance">
                                        <text :class="sort==='distance' ? 'active' : ''">距离 ↕︎</text>
                                </u-col>
                                <u-col span="4" class="filter-item" @click="openRating">
                                        <text :class="sort==='rating' ? 'active' : ''">评分 ↕︎</text>
                                </u-col>
                                <u-col span="4" class="filter-item filter-icon" @click="openFilter">
                                        <u-icon name="list" size="18" color="#606266" />
                                        <text>筛选</text>
                                </u-col>
                        </u-row>
                </view>

                <view class="venue-list">
                        <view v-for="(v,i) in venues" :key="i" class="venue-card" @click="goDetail(v)">
                                <image :src="v.image" class="venue-img" mode="aspectFill" />
                                <view class="venue-info">
                                        <view class="title">{{ v.title }}</view>
                                        <view class="rating">{{ v.rating }}</view>
                                        <view class="tags">
                                                <u-tag v-for="(t,index) in v.tags" :key="index" :text="t" type="info" size="mini" plain :color="themeColor" :border-color="themeColor" custom-class="tag" />
                                        </view>
                                        <view class="distance">{{ v.distance }}</view>
                                </view>
                        </view>
                        <u-empty v-if="venues.length===0" text="暂无数据" mode="list" />
                        <u-loadmore :status="loadStatus" />
                </view>

                <u-action-sheet :show="showDistanceSheet" :actions="distanceOptions" @select="onDistanceSelect" @close="showDistanceSheet=false" />
                <u-action-sheet :show="showRatingSheet" :actions="ratingOptions" @select="onRatingSelect" @close="showRatingSheet=false" />
                <u-drawer :show="filterDrawer" mode="right" @close="filterDrawer=false">
                        <view style="padding:24rpx">筛选内容</view>
                </u-drawer>
        </view>
</template>

<script>
export default {
        data() {
                return {
                        themeColor: '#1FCF76',
                        city: '上海',
                        banners: [
                                'https://via.placeholder.com/750x200'
                        ],
                        tabList: [
                                { name: '羽毛球' },
                                { name: '排球' },
                                { name: '篮球' }
                        ],
                        currentTab: 0,
                        sort: '',
                        venues: [],
                        loadStatus: 'loadmore',
                        showDistanceSheet: false,
                        showRatingSheet: false,
                        distanceOptions: [ {name:'500米内'}, {name:'1公里内'}, {name:'5公里内'} ],
                        ratingOptions: [ {name:'评分从高到低'}, {name:'评分从低到高'} ],
                        filterDrawer: false
                }
        },
        methods: {
                changeCity() {
                        // TODO: 打开城市选择弹窗
                },
                goSearch() {
                        // TODO: 跳转搜索页
                },
                goBooking() {
                        // TODO: 跳转预约页面
                },
                locate() {
                        // TODO: 定位
                },
                openDistance() {
                        this.showDistanceSheet = true
                },
                onDistanceSelect(e) {
                        this.sort = 'distance'
                        this.showDistanceSheet = false
                },
                openRating() {
                        this.showRatingSheet = true
                },
                onRatingSelect(e) {
                        this.sort = 'rating'
                        this.showRatingSheet = false
                },
                openFilter() {
                        this.filterDrawer = true
                },
                goDetail(v) {
                        // TODO: 跳转详情
                },
                onTabChange(index) {
                        this.currentTab = index
                }
        }
}
</script>

<style scoped>
.home-page {
        background: #F5F5F5;
        min-height: 100vh;
        padding: 24rpx;
}
.search {
        flex: 1;
}
.banner {
        margin-top: 20rpx;
        border-radius: 8px;
        overflow: hidden;
}
.tabs {
        margin-top: 20rpx;
}
.filter-row {
        margin-top: 20rpx;
}
.filter-item {
        text-align: center;
        font-size: 28rpx;
        color: #606266;
}
.filter-item.active,
.filter-item text.active {
        color: #1FCF76;
}
.filter-icon {
        display: flex;
        justify-content: center;
        align-items: center;
}
.filter-icon text {
        margin-left: 8rpx;
}
.venue-card {
        background: #FFFFFF;
        border-radius: 8px;
        box-shadow: 0 2rpx 8rpx rgba(0, 0, 0, 0.05);
        padding: 24rpx;
        display: flex;
        margin-top: 20rpx;
}
.venue-img {
        width: 140rpx;
        height: 140rpx;
        border-radius: 8px;
        margin-right: 20rpx;
}
.venue-info {
        flex: 1;
        position: relative;
}
.title {
        font-size: 30rpx;
        font-weight: 600;
        color: #202020;
        margin-right: 80rpx;
}
.rating {
        position: absolute;
        right: 0;
        top: 0;
        color: #1FCF76;
        font-size: 30rpx;
}
.tags {
        margin-top: 40rpx;
        display: flex;
        flex-wrap: wrap;
}
.tag {
        margin-right: 10rpx;
        margin-bottom: 10rpx;
        padding: 0 10rpx;
}
.distance {
        color: #909399;
        font-size: 22rpx;
        margin-top: 10rpx;
}
</style>
