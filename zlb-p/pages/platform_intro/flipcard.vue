<template>
	<view class="container">
		<!-- 标题在最上面 -->
		<view class="header">
			<text class="title">记忆翻牌小游戏</text>
			<view class="stats">
				<text>步数：{{ moves }}</text>
				<text>用时：{{ formatTime(elapsed) }}</text>
			</view>
		</view>

		<!-- 12 张正方形卡片 -->
		<u-grid :column-num="4" border="false" square>
			<u-grid-item v-for="(card, index) in cards" :key="index" class="grid-item" @click="flipCard(index)">
				<view :class="['card', card.flipped || card.matched ? 'flipped' : '']">
					<view class="front">{{ card.flipped || card.matched ? card.value : '' }}</view>
					<view class="back"></view>
				</view>
			</u-grid-item>
		</u-grid>

		<view class="controls">
			<u-button class="reset-btn" @click="resetGame">
				<u-icon name="reload" size="24" /> 重新开始
			</u-button>
			<u-button class="history-btn" @click="showHistory">
				<u-icon name="file-text" size="24" /> 查看记录
			</u-button>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				moves: 0, // 已翻步数
				firstIndex: null, // 本轮第一次翻开的卡片索引
				lockBoard: false, // 防止快速连续点击
				cards: [], // 卡片数组
				timerId: null, // 计时器句柄
				elapsed: 0, // 已用秒数
				history: [] // 历史记录
			};
		},
		mounted() {
			// 先读本地历史，再开始新游戏
			const stored = uni.getStorageSync('memoryHistory');
			if (Array.isArray(stored)) {
				this.history = stored;
			}
			this.resetGame();
		},
		methods: {
			// 格式化秒数为 mm:ss
			formatTime(sec) {
				const m = String(Math.floor(sec / 60)).padStart(2, '0');
				const s = String(sec % 60).padStart(2, '0');
				return `${m}:${s}`;
			},
			// 重置游戏并启动计时
			resetGame() {
				if (this.timerId) clearInterval(this.timerId);
				this.elapsed = 0;
				// 6 对卡片，共 12 张
				const values = [1, 2, 3, 4, 5, 6, 1, 2, 3, 4, 5, 6];
				const shuffled = values.sort(() => 0.5 - Math.random());
				this.cards = shuffled.map(v => ({
					value: v,
					flipped: false,
					matched: false
				}));
				this.moves = 0;
				this.firstIndex = null;
				this.lockBoard = false;
				// 启动每秒 +1
				this.timerId = setInterval(() => {
					this.elapsed++;
				}, 1000);
			},
			// 点击翻牌逻辑
			flipCard(idx) {
				if (this.lockBoard) return;
				const card = this.cards[idx];
				if (card.flipped || card.matched) return;
				this.$set(this.cards, idx, {
					...card,
					flipped: true
				});

				if (this.firstIndex === null) {
					this.firstIndex = idx;
				} else {
					this.moves++;
					this.lockBoard = true;
					const firstCard = this.cards[this.firstIndex];
					if (firstCard.value === card.value) {
						// 配对成功
						this.cards[this.firstIndex].matched = true;
						this.cards[idx].matched = true;
						this.lockBoard = false;
						this.firstIndex = null;
						// 全部完成，记录历史并停止
						if (this.cards.every(c => c.matched)) {
							clearInterval(this.timerId);
							this.history.push({
								moves: this.moves,
								time: this.elapsed
							});
							uni.setStorageSync('memoryHistory', this.history);
						}
					} else {
						// 不配对，1s 后复原
						setTimeout(() => {
							this.cards[this.firstIndex].flipped = false;
							this.cards[idx].flipped = false;
							this.firstIndex = null;
							this.lockBoard = false;
						}, 1000);
					}
				}
			},
			// 查看历史
			showHistory() {
				const list = this.history;
				if (!list.length) {
					return uni.showToast({
						title: '暂无记录',
						icon: 'none'
					});
				}
				let msg = '';
				list.forEach((item, i) => {
					msg += `${i+1}. 步数 ${item.moves}，用时 ${this.formatTime(item.time)}\n`;
				});
				uni.showModal({
					title: '历史记录',
					content: msg,
					showCancel: false
				});
			}
		},
		beforeDestroy() {
			if (this.timerId) clearInterval(this.timerId);
		}
	};
</script>


<style lang="scss" scoped>
.container {
  padding: 20px;
  background-color: #fff;
}
.header {
  margin-bottom: 15px;
}
.title {
  font-size: 24px;
  color: #BB4FE1;
  text-align: center;
  margin-bottom: 8px;
}
.stats {
  display: flex;
  justify-content: center;
  gap: 30px;
  font-size: 16px;
  color: #666;
  margin-top: 20rpx;
}
.grid-item {
  // padding: 15px;
  /* 不再固定高度，交给卡片自己撑开 */
}
.card {
  width: 100%;
  aspect-ratio: 1;               /* 保证正方形 */
  border-radius: 8px;
  perspective: 800px;
  transform-style: preserve-3d;
  transition: transform 0.4s;
  position: relative;
}
.card.flipped {
  transform: rotateY(180deg);
}
.front, .back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #fff;
}
.front {
  transform: rotateY(180deg);
  background-color: #BB4FE1;  /* 正面主题色 */
}
.back {
  transform: rotateY(0deg);
  background-color: #ccc;     /* 背面灰色 */
}
.controls {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;
}
.reset-btn, .history-btn {
  flex: 1;
  margin: 0 5px;
  background-color: #BB4FE1;
  color: #fff;
}
</style>
