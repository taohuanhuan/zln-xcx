<template>
	<view class="badges-page">
		<view class="badge-card" v-for="b in badges" :key="b.id" :style="{background:b.bg}">
			<view class="info">
				<image :src="b.icon" class="icon" mode="aspectFit"></image>
				<view class="name">{{b.name}}</view>
				<view class="desc">{{b.description}}</view>
			</view>
			<view class="action">
				<u-button v-if="myIds.includes(b.id)" disabled type="success" size="mini">已领取</u-button>
				<u-button v-else size="mini" color="#BB4FE1" @click="openClaim(b)">领取</u-button>
			</view>
		</view>

		<u-popup :show="show" mode="center" @close="show=false">
			<view class="popup">
				<view class="title">领取徽章</view>
				<u-input v-model="mood" placeholder="此刻心情" border="surround" />
				<u-datetime-picker v-model="time" return-type="timestamp" />
				<view class="popup-action">
					<u-button @click="submitClaim" color="#BB4FE1">确定</u-button>
				</view>
			</view>
		</u-popup>
	</view>
</template>

<script>
	import {
		getBadgeList,
		getMyBadges,
		claimBadge
	} from '@/config/api'
	export default {
		data() {
			return {
				badges: [],
				myIds: [],
				show: false,
				current: null,
				mood: '',
				time: Date.now()
			}
		},
		async onShow() {
			await this.loadData()
			
		},
		methods: {
			async loadData() {
				console.log("123")
				try {
					const [allRes, myRes] = await Promise.all([getBadgeList(), getMyBadges()])
					this.badges = (allRes.data || []).map(item => {
						item.bg = 'linear-gradient(135deg,#fdfbfb 0%,#ebedee 100%)'
						return item
					})
					this.myIds = (myRes.data || []).map(i => i.id)
				} catch (e) {
					console.log('load fail', e)
				}
			},
			openClaim(b) {
				this.current = b
				this.show = true
				this.mood = ''
				this.time = Date.now()
			},
			async submitClaim() {
				try {
					await claimBadge({
						badge_id: this.current.id,
						mood: this.mood,
						get_time: this.time
					})
					this.myIds.push(this.current.id)
					this.show = false
					uni.showToast({
						title: '领取成功',
						icon: 'success'
					})
				} catch (e) {
					uni.showToast({
						title: e.msg || '领取失败',
						icon: 'none'
					})
				}
			}
		}
	}
</script>

<style scoped>
	.badges-page {
		padding: 30rpx;
	}

	.badge-card {
		margin-bottom: 30rpx;
		padding: 20rpx;
		border-radius: 20rpx;
		box-shadow: 0 4rpx 10rpx rgba(0, 0, 0, 0.05);
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

	.icon {
		width: 80rpx;
		height: 80rpx;
		margin-right: 20rpx;
	}

	.info {
		display: flex;
		flex-direction: column;
	}

	.name {
		font-size: 30rpx;
		font-weight: 600;
	}

	.desc {
		color: #666;
		font-size: 24rpx;
		margin-top: 8rpx;
	}

	.popup {
		background: #fff;
		padding: 30rpx;
		border-radius: 16rpx;
		width: 560rpx;
	}

	.title {
		font-size: 32rpx;
		margin-bottom: 20rpx;
		text-align: center;
	}

	.popup-action {
		margin-top: 20rpx;
		text-align: center;
	}
</style>