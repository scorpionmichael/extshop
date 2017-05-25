page.includeCSS.shopCss = EXT:scorpshop/Resources/Public/Css/style.css

plugin.tx_scorpshop_shop {
  view {
    templateRootPaths.0 = EXT:scorpshop/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_scorpshop_shop.view.templateRootPath}
    partialRootPaths.0 = EXT:scorpshop/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_scorpshop_shop.view.partialRootPath}
    layoutRootPaths.0 = EXT:scorpshop/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_scorpshop_shop.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_scorpshop_shop.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_scorpshop._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-scorpshop table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-scorpshop table th {
        font-weight:bold;
    }

    .tx-scorpshop table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
