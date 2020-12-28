// スクロールバーのサイズを取得する
// スクロールバーがない場合は0を返却
export const getScrolllbarWidth = () => {
    const el = document.createElement('div')
    el.setAttribute('style', 'visibility:hidden;position:absolute;top:0;left:0;width:100vw;')
    document.body.appendChild(el)
    const vw = parseInt(window.getComputedStyle(el).width)
    el.style.width = '100%'
    const pc = parseInt(window.getComputedStyle(el).width)
    document.body.removeChild(el)

    const scrollbarWidth = vw - pc
    return scrollbarWidth
}
