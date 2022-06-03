# NoWorldCorruption
ワールドが腐敗するのを防ぐプラグイン

## `config.yml`について
`mode`は`denylist`あるいは`allowlist`を使用できます。  
- `denylist`: 指定したワールドでのイベントの発生を抑制します
- `allowlist`: 指定されたワールドでのみイベントを許可します

## 無効化する機能のリスト
### ブロックが燃えて消える (`BlockBurnEvent`)
### 新しいブロックの生成 (`BlockFormEvent`)
- 水と溶岩が接した際に生成される石や黒曜石などのブロック
- コンクリートパウダーと水が触れた際に生成されるコンクリート
### ブロックの成長 (`BlockGrowEvent`)
- サボテン、サトウキビ、カカオ豆、ネザーウォート、スイートベリー、小麦やスイカなどの植物の成長
### ブロックが溶ける (`BlockMeltEvent`)
- 雪/氷/薄氷が溶ける
### ブロックがまわりに広がる (`BlockSpreadEvent`)
- 草/土/菌糸ブロックの広がり
- 液体の広がり
- 火の広がり
### ブロックのテレポート (`BlockTeleportEvent`)
- ドラゴンエッグ
### ブロックの更新 (`BlockUpdateEvent`)
- TNTが地形を破壊したときに周囲のブロックの更新を行わない
- プレイヤーがブロックを設置/破壊したときに周囲のブロックの更新を行わない
  - ただしFlowableなブロックと当たり判定が存在しないブロックは更新される
- など…
### 耕された土を踏んだ時に土に戻る (`EntityTrampleFarmlandEvent`)
### 葉っぱの自動破壊 (`LeavesDecayEvent`)
### 絵画の破壊 (`PaintingBreakEvent`)
クリエイティブ以外のプレイヤーによる絵画の破壊のみ扱います  
(PocketMine-MPには存在しないイベントです)
### 構造物の成長 (`StructureGrowEvent`)
プレイヤーが関与した場合を除きます
- 竹
- 苗木の成長
