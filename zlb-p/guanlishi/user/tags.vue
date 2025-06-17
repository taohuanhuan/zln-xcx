<template>
	<view class="main">
		<view class="container">
			<u-checkbox-group v-model="checked" placement="row">
				<u-checkbox class="sss" activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
				<u-checkbox activeColor="#AE38D7" label="情绪压力"></u-checkbox>
			</u-checkbox-group>
		</view>
		<view class="btn">
			确认
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		}
	}
</script>

<style lang="scss" scoped>
	.main{

		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		.container{
			border-radius: 16rpx;
			background-color: white;
			width: 690rpx;
			padding: 30rpx;
			box-sizing: border-box;
		
		}
	}
	
	.btn{
		position: fixed;
		bottom: 50rpx;
		left: 30rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient( 90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		line-height: 88rpx;
		text-align: center;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		margin-top: 100rpx;
	}

</style>

<style lang="scss">
	.u-checkbox-group{
		flex-wrap: wrap;
		justify-content: space-between;
	}
	.u-checkbox{
		width: 210rpx;
		overflow: hidden;
		margin-bottom: 20rpx;
	}
</style>
