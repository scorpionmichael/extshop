
plugin.tx_scorpshop_shop {
  view {
    # cat=plugin.tx_scorpshop_shop/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:scorpshop/Resources/Private/Templates/
    # cat=plugin.tx_scorpshop_shop/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:scorpshop/Resources/Private/Partials/
    # cat=plugin.tx_scorpshop_shop/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:scorpshop/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_scorpshop_shop//a; type=string; label=Default storage PID
    storagePid = 
  }
}