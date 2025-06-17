<template>
	<view>
		<view class="main">
			<view class="title">{{title}}</view>
			<view class="desc">{{desc}}</view>
		</view>
	</view>
</template>

<script>
	export default {
		name:"CCell",
		data() {
			return {
				
			};
		},
		props:{
			title:{
				type:String,
				default:''
			},
			desc:{
				type:String,
				default:''
			},
		}
	}
</script>

<style lang="scss" scoped>
.main{
	width: 690rpx;
	height: 80rpx;
	line-height: 80rpx;
	display: flex;
	// background-color: red;
	.title{
		width: 180rpx;
		font-weight: 400;
		font-size: 28rpx;
		color: #666666;
		line-height: 80rpx;
		text-align: left;
	}
	.desc{
		font-weight: 400;
		font-size: 28rpx;
		color: #242424;
		line-height: 80rpx;
		text-align: center;
	}
}
</style>