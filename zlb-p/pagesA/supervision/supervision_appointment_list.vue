<template>
	<view class="container" style="width:690rpx">


		<view class="search">

			<u-search placeholder="请输入关键词搜索查询" height="72rpx" shape="round" v-model="keyword" bgColor="#ffffff"
				:show-action="false"  @search="searchData"></u-search>

		</view>


		<view style="margin: 0 0 20rpx 0;">
			<u-swiper :list="list1" @change="change" @click="click" height="300rpx"></u-swiper>
		</view>

		<view class="" style="background-color: #ffffff;margin: 0 -30rpx;">
			<u-tabs :scrollable="true" :list="tabs" @click="changeTab" lineWidth="30" lineHeight="5" lineColor="#C871E7"
				:activeStyle="{
			        fontWeight: 'bold',
			    }"></u-tabs>
		</view>

		<view class="sort-options">
			<view class="sort-item" @click="toggleSort('style')" :class="{ active: isSelected('style') }">
				<span>流派</span>
				<view class="sort-icons">
					<view class="triangle-up" :class="{ active: isAscending('style') }"></view>
					<view class="triangle-down" :class="{ active: isDescending('style') }"></view>
				</view>
			</view>
			<!-- <view class="sort-item" @click="toggleSort('direction')" :class="{ active: isSelected('direction') }">
				<span>方向</span>
				<view class="sort-icons">
					<view class="triangle-up" :class="{ active: isAscending('direction') }"></view>
					<view class="triangle-down" :class="{ active: isDescending('direction') }"></view>
				</view>
			</view> -->
			<view class="sort-item" @click="toggleSort('price')" :class="{ active: isSelected('price') }">
				<span>价格范围</span>
				<view class="sort-icons">
					<view class="triangle-up" :class="{ active: isAscending('price') }"></view>
					<view class="triangle-down" :class="{ active: isDescending('price') }"></view>
				</view>
			</view>
			<view class="sort-item" @click="toggleSort('date')" :class="{ active: isSelected('date') }">
				<span>近期可约</span>
				<view class="sort-icons">
					<view class="triangle-up" :class="{ active: isAscending('date') }"></view>
					<view class="triangle-down" :class="{ active: isDescending('date') }"></view>
				</view>
			</view>
		</view>



		<view class="counselor-item" @click="goDetail(item.consultant_id)" v-for="(item,idx) in users" :key="idx">
			<image class="counselor-image" :src="item.consultant_avator|avatarFilter"></image>
			<view class="counselor-info">
				<view class="counselor-name-row">
					<text class="counselor-name">{{item.consultant_name}}</text>

				</view>
				<text class="counselor-detail" style="color: #555555;">{{item.consultant_sect}}
				</text>
				<text class="counselor-detail" style="color: #999999;">最早可预约时间：<text style="color: #555555;">{{item.earliest_time}}</text></text>
				<view class="counselor-stats-row">
					<text class="counselor-stats" style="color: #999999;"><text style="color: #EF851A;">{{item.consult_count}}</text>人咨询 ·
						<text style="color: #EF851A;">{{item.favorable_rate}}%</text>好评</text>
				</view>
			</view>
		</view>


		</van-tab>
		</van-tabs>


		<view class="" style="height: 500rpx; width: 300rpx;">

		</view>
	</view>
</template>
<script>
	import {
		getConsultantList,
		getBannerList
	} from '@/config/api.js'
	
	import {
		DOMAIN
	} from '@/config/config.js';
	
	export default {
		data() {
			return {
				value: "",
				tabs: [{
					id:1,
					name: '团体督导',
				}, {
					id:2,
					name: '个体督导',
				}, {
					id:3,
					name: '1V2督导',
				}],
				list1: [],
				items: [{
						id: 1,
						name: '项目1',
						style: 'A',
						direction: 'X',
						price: 100,
						date: '2024-08-20'
					},
					{
						id: 2,
						name: '项目2',
						style: 'B',
						direction: 'Y',
						price: 200,
						date: '2024-08-21'
					},
					// 更多列表项
				],
				sortKey: '',
				sortOrder: '',
				users:[],
				keyword:'',
				activeTab:1
			};
		},
		computed: {
			sortedItems() {
				if (this.sortKey) {
					return this.items.slice().sort((a, b) => {
						if (this.sortOrder === 'asc') {
							return a[this.sortKey] > b[this.sortKey] ? 1 : -1;
						} else {
							return a[this.sortKey] < b[this.sortKey] ? 1 : -1;
						}
					});
				}
				return this.items;
			}
		},
		onLoad() {
			
			getBannerList({
				banner_type: 3
			}).then((data) => {
				data.forEach(item => {
					this.list1.push(DOMAIN + item.banner_picture)
				})
			})
			
			getConsultantList({
				page:1,
				limit:1000
			}).then((data)=>{
				this.users = data
			})
		},
		methods: {
			changeTab(e){
				this.activeTab = e.id
				getConsultantList({
					page:1,
					limit:1000,
					supervision_type:e.id
				}).then((data)=>{
					this.users = data
				})
			},
			searchData(){
				let keyword= this.keyword
				this.keyword = ''
				uni.navigateTo({
					url:'/pages/platform_intro/search_con_result?keyword='+keyword
				})
			},
			goDetail(id) {
				wx.navigateTo({
					url: '/pages/supervision/supervisor_details?id='+id
				});
			},

			navigateToPage(index) {
				const routes = [
					'/pages/supervision/supervisor_details',
				];
				wx.navigateTo({
					url: routes[0]
				});
			},
			toggleSort(key) {
				if (this.sortKey === key) {
					this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
				} else {
					this.sortKey = key;
					this.sortOrder = 'asc';
				}
			},
			isAscending(key) {
				return this.sortKey === key && this.sortOrder === 'asc';
			},
			isDescending(key) {
				return this.sortKey === key && this.sortOrder === 'desc';
			},
			isSelected(key) {
				return this.sortKey === key;
			}
		}
	}
</script>

<style scoped>
	page {}

	.container {
		height: 100vh;
		width: 690rpx;
	}

	.search {
		padding: 30rpx 0 20rpx 0;
	}

	.van-search__content {
		background-color: #ffffff !important;
	}

	.van-search {
		padding: 0 0 !important;
		background-color: rgba(0, 0, 0, 0) !important;
	}

	.my-swipe .van-swipe-item {
		color: #fff;
		font-size: 20px;
		line-height: 300rpx;
		text-align: center;
		background-color: #39a9ed;
		border-radius: 24rpx;
	}

	/* 为图片设置的样式 */
	.my-swipe img {
		border-radius: 24rpx;

		display: block;
		/* 确保没有额外的空白 */
		width: 100%;
		/* 使图片宽度填满容器 */
		height: auto;
		/* 保持图片的宽高比 */
	}

	.m-b-20 {
		margin-bottom: 30rpx;
	}

	.m-l-10 {
		margin: 0 5rpx;
	}


	.sort-options {
		display: flex;
		justify-content: space-around;
		padding: 24rpx;
		background-color: #ffffff;
		font-size: 26rpx;
		margin: 0 -30rpx;

	}

	.sort-item {
		display: flex;
		align-items: center;
		cursor: pointer;
	}

	.sort-icons {
		display: flex;
		flex-direction: column;
		align-items: center;
		margin-left: 5px;
		/* 控制文字与图标的间距 */
	}

	.sort-icons .triangle-up,
	.sort-icons .triangle-down {
		width: 0;
		height: 0;
		border-left: 10rpx solid transparent;
		border-right: 10rpx solid transparent;
		margin: 2px 0;
	}

	.triangle-up {
		border-bottom: 10rpx solid #999999;
	}

	.triangle-down {
		border-top: 10rpx solid #999999;
	}

	.triangle-up.active {
		border-bottom-color: #242424;
	}

	.triangle-down.active {
		border-top-color: #242424;
	}

	.sort-item.active span {
		font-weight: bold;
		/* 选中状态下文字加粗 */
	}

	.counselor-item {
		display: flex;
		padding: 30rpx 20rpx;
		margin: 30rpx 0;
		background-color: #fff;
		border-radius: 24rpx;
	}

	.counselor-image {
		width: 160rpx;
		height: 160rpx;
		min-width: 160rpx;
		border-radius: 16rpx;
		margin-right: 20rpx;
	}

	.counselor-info {
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}

	.counselor-name-row {
		display: flex;
		align-items: center;
		margin-bottom: 20rpx;
	}

	.counselor-name {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
		margin-right: 10rpx;
	}

	.counselor-detail {
		font-size: 24rpx;
		margin-bottom: 20rpx;
		line-height: 40rpx;
	}

	.counselor-stats-row {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.counselor-stats {
		font-size: 24rpx;
		color: #EF851A;
	}
</style>