<template>
	<view class="main">
		<image src="../../static/temp/yaoqing.png" mode="widthFix"></image>
		<view class="btn" @click="navPage('/pages/yaoqing/fenxiaoshang')">申请成为分销商</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		methods:{
			navPage(url){
				uni.navigateTo({
					url
				})
			}
		}
	} 
</script>

<style lang="scss" scoped>
.main{
	margin: 0 -30rpx;
	width: 750rpx;
	image{
		width: 100%;
		height: 100%;
	}
	.btn{
		position: fixed;
		bottom: 50rpx;
		left: 30rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		text-align: center;
		line-height: 88rpx;
	}
}

</style>
