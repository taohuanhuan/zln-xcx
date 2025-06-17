<template>
	<view class="main">
		<view class="feiyong">
			<view class="title">就诊记录标题</view>
			<CCell title="就诊时长" desc="40分钟"></CCell>
			<CCell title="就诊时间" desc="2024.07.10 08:28——18"></CCell>

			<view style="width: 630rpx;height: 2rpx;background: #F6F6F6;margin-top: 20rpx;margin-bottom: 20rpx;"></view>
			<view class="text">
				间一民样除安被查比把才热万片适连又得用常个少二间代队当组车义多低政后情照群了他产总会合加立置。第半动个示包数才高安组王下约积五自外马战子约听表快市义温际身严各小整头必张该写许只共提文即住。受维给物龙见公历小西院但北众社应党离具育正后该报育置有查月件据写增科布四况着明现周报飞省。因素出有表难热七目定料只地记统强率选构得安路必米道号准之列联决科精打议象此劳直么知节取电八。总命国基几据解事性数任保感速内府织门道场容目通给今少住自有精期飞值红织维身标万土市指质取相。白教片要至十革须支区火布较文新以白决张住原号队可单已通别算物国动由达易头界单商马调将成构马来气四习提面信观交等算为龙查还温记存想人性造样离一直动响实论色界合自知数期者确的西。金车联两证上自离正今与织布际即治论使总长精话飞品第委增该已大能条济得本都阶包特才量。
			</view>
		</view>
	</view>
</template>

<script>
	import CCell from '@/components/CCell.vue'
	export default {
		data() {
			return {

			};
		},
		components: {
			CCell
		},
	}
</script>

<style lang="scss" scoped>
	.main {
		background-color: #F6F6F6;
		min-height: 100vh;
		padding-left: 30rpx;
		padding-right: 30rpx;
	}

	.title {
		font-weight: bold;
		font-size: 32rpx;
		color: #242424;
	}

	.feiyong {
		padding: 30rpx;
		box-sizing: border-box;
		background-color: white;
		margin-top: 20rpx;
		border-radius: 16rpx;

		.text {
			font-weight: 400;
			font-size: 28rpx;
			color: #242424;
			text-align: justify;
		}
	}
</style>

<style>
	page {
		background-color: #F6F6F6;
		/* 这里设置你想要的背景颜色 */
		padding: 0 0;
	}
</style>