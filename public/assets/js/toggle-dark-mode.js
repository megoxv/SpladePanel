const ThemeAppearance = {
    init() {
        const defaultTheme = 'default'
        let theme = localStorage.getItem('theme') || defaultTheme

        if (document.querySelector('html').classList.contains('dark')) return
        this.setAppearance(theme)
    },
    _resetStylesOnLoad() {
        const $resetStyles = document.createElement('style')
        $resetStyles.innerText = `*{transition: unset !important;}`
        $resetStyles.setAttribute('data-appearance-onload-styles', '')
        document.head.appendChild($resetStyles)
        return $resetStyles
    },
    setAppearance(theme, saveInStore = true, dispatchEvent = true) {
        const $resetStylesEl = this._resetStylesOnLoad()

        if (saveInStore) {
            localStorage.setItem('theme', theme)
        }

        if (theme === 'auto') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'
        }

        document.querySelector('html').classList.remove('dark')
        document.querySelector('html').classList.remove('default')
        document.querySelector('html').classList.remove('auto')

        document.querySelector('html').classList.add(this.getOriginalAppearance())

        setTimeout(() => {
            $resetStylesEl.remove()
        })

        if (dispatchEvent) {
            window.dispatchEvent(new CustomEvent('on-appearance-change', {detail: theme}))
        }
    },
    getAppearance() {
        let theme = this.getOriginalAppearance()
        if (theme === 'auto') {
            theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'
        }
        return theme
    },
    getOriginalAppearance() {
        const defaultTheme = 'default'
        return localStorage.getItem('theme') || defaultTheme
    }
}
ThemeAppearance.init()

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
    if (ThemeAppearance.getOriginalAppearance() === 'auto') {
        ThemeAppearance.setAppearance('auto', false)
    }
})

window.addEventListener('load', () => {
    const $clickableThemes = document.querySelectorAll('[data-theme-click-value]')
    const $switchableThemes = document.querySelectorAll('[data-theme-switch]')

    $clickableThemes.forEach($item => {
        $item.addEventListener('click', () => ThemeAppearance.setAppearance($item.getAttribute('data-theme-click-value'), true, $item))
    })

    $switchableThemes.forEach($item => {
        $item.addEventListener('change', (e) => {
            ThemeAppearance.setAppearance(e.target.checked ? 'dark' : 'default')
        })

        $item.checked = ThemeAppearance.getAppearance() === 'dark'
    })

    window.addEventListener('on-appearance-change', e => {
        $switchableThemes.forEach($item => {
            $item.checked = e.detail === 'dark'
        })
    })
})