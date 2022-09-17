import "./bootstrap";

import Alpine from "alpinejs";
import Tooltip from "@ryangjchandler/alpine-tooltip";
import collapse from '@alpinejs/collapse'

Alpine.plugin(Tooltip);
Alpine.plugin(collapse)

window.Alpine = Alpine;

Alpine.start();
