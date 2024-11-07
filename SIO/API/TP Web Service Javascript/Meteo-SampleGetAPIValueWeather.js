

/*
 * get Descprition with code weather parameter
 * and return description weather
 */
function getDescriptionWeather(codeWeather) {
	var descriptionWeather = '';

	switch (codeWeather) {
		case 0:
			descriptionWeather = 'Soleil';
			break;
		case 1:
			descriptionWeather = 'Peu nuageux';
			break;
		case 2:
			descriptionWeather = 'Ciel voilé';
			break;
		case 3:
			descriptionWeather = 'Nuageux';
			break;
		case 4:
			descriptionWeather = 'Très nuageux';
			break;
		case 5:
			descriptionWeather = 'Couvert';
			break;
		case 6:
			descriptionWeather = 'Brouillard';
			break;
		case 7:
			descriptionWeather = 'Brouillard givrant';
			break;
		case 10:
			descriptionWeather = 'Pluie faible';
			break;
		case 11:
			descriptionWeather = 'Pluie modérée';
			break;
		case 12:
			descriptionWeather = 'Pluie forte';
			break;
		case 13:
			descriptionWeather = 'Pluie faible verglaçante';
			break;
		case 14:
			descriptionWeather = 'Pluie modérée verglaçante';
			break;
		case 15:
			descriptionWeather = 'Pluie forte verglaçante';
			break;
		case 16:
			descriptionWeather = 'Bruine';
			break;
		case 20:
			descriptionWeather = 'Neige faible';
			break;
		case 21:
			descriptionWeather = 'Neige modérée';
			break;
		case 22:
			descriptionWeather = 'Neige forte';
			break;
		case 30:
			descriptionWeather = 'Pluie et neige mêlées faibles';
			break;
		case 31:
			descriptionWeather = 'Pluie et neige mêlées modérées';
			break;
		case 32:
			descriptionWeather = 'Pluie et neige mêlées fortes';
			break;
		case 40:
			descriptionWeather = 'Averses de pluie locales et faibles';
			break;
		case 41:
			descriptionWeather = 'Averses de pluie locales';
			break;
		case 42:
			descriptionWeather = 'Averses locales et fortes';
			break;
		case 43:
			descriptionWeather = 'Averses de pluie faibles';
			break;
		case 44:
			descriptionWeather = 'Averses de pluie';
			break;
		case 45:
			descriptionWeather = 'Averses de pluie fortes';
			break;
		case 46:
			descriptionWeather = 'Averses de pluie faibles et fréquentes';
			break;
		case 47:
			descriptionWeather = 'Averses de pluie fréquentes';
			break;
		case 48:
			descriptionWeather = 'Averses de pluie fortes et fréquentes';
			break;
		case 60:
			descriptionWeather = 'Averses de neige localisées et faibles';
			break;
		case 61:
			descriptionWeather = 'Averses de neige localisées';
			break;
		case 62:
			descriptionWeather = 'Averses de neige localisées et fortes';
			break;
		case 63:
			descriptionWeather = 'Averses de neige faibles';
			break;
		case 64:
			descriptionWeather = 'Averses de neige';
			break;
		case 65:
			descriptionWeather = 'Averses de neige fortes';
			break;
		case 66:
			descriptionWeather = 'Averses de neige faibles et fréquentes';
			break;
		case 67:
			descriptionWeather = 'Averses de neige fréquentes';
			break;
		case 68:
			descriptionWeather = 'Averses de neige fortes et fréquentes';
			break;
		case 70:
			descriptionWeather =
				'Averses de pluie et neige mêlées localisées et faibles';
			break;
		case 71:
			descriptionWeather = 'Averses de pluie et neige mêlées localisées';
			break;
		case 72:
			descriptionWeather =
				'Averses de pluie et neige mêlées localisées et fortes';
			break;
		case 73:
			descriptionWeather = 'Averses de pluie et neige mêlées faibles';
			break;
		case 74:
			descriptionWeather = 'Averses de pluie et neige mêlées';
			break;
		case 75:
			descriptionWeather = 'Averses de pluie et neige mêlées fortes';
			break;
		case 76:
			descriptionWeather =
				'Averses de pluie et neige mêlées faibles et nombreuses';
			break;
		case 77:
			descriptionWeather = 'Averses de pluie et neige mêlées fréquentes';
			break;
		case 78:
			descriptionWeather =
				'Averses de pluie et neige mêlées fortes et fréquentes';
			break;
		case 100:
			descriptionWeather = 'Orages faibles et locaux';
			break;
		case 101:
			descriptionWeather = 'Orages locaux';
			break;
		case 102:
			descriptionWeather = 'Orages fort et locaux';
			break;
		case 103:
			descriptionWeather = 'Orages faibles';
			break;
		case 104:
			descriptionWeather = 'Orages';
			break;
		case 105:
			descriptionWeather = 'Orages forts';
			break;
		case 106:
			descriptionWeather = 'Orages faibles et fréquents';
			break;
		case 107:
			descriptionWeather = 'Orages fréquents';
			break;
		case 108:
			descriptionWeather = 'Orages forts et fréquents';
			break;
		case 120:
			descriptionWeather = 'Orages faibles et locaux de neige ou grésil';
			break;
		case 121:
			descriptionWeather = 'Orages locaux de neige ou grésil';
			break;
		case 122:
			descriptionWeather = 'Orages locaux de neige ou grésil';
			break;
		case 123:
			descriptionWeather = 'Orages faibles de neige ou grésil';
			break;
		case 124:
			descriptionWeather = 'Orages de neige ou grésil';
			break;
		case 125:
			descriptionWeather = 'Orages de neige ou grésil';
			break;
		case 126:
			descriptionWeather = 'Orages faibles et fréquents de neige ou grésil';
			break;
		case 127:
			descriptionWeather = 'Orages fréquents de neige ou grésil';
			break;
		case 128:
			descriptionWeather = 'Orages fréquents de neige ou grésil';
			break;
		case 130:
			descriptionWeather =
				'Orages faibles et locaux de pluie et neige mêlées ou grésil';
			break;
		case 131:
			descriptionWeather = 'Orages locaux de pluie et neige mêlées ou grésil';
			break;
		case 132:
			descriptionWeather =
				'Orages fort et locaux de pluie et neige mêlées ou grésil';
			break;
		case 133:
			descriptionWeather = 'Orages faibles de pluie et neige mêlées ou grésil';
			break;
		case 134:
			descriptionWeather = 'Orages de pluie et neige mêlées ou grésil';
			break;
		case 135:
			descriptionWeather = 'Orages forts de pluie et neige mêlées ou grésil';
			break;
		case 136:
			descriptionWeather =
				'Orages faibles et fréquents de pluie et neige mêlées ou grésil';
			break;
		case 137:
			descriptionWeather =
				'Orages fréquents de pluie et neige mêlées ou grésil';
			break;
		case 138:
			descriptionWeather =
				'Orages forts et fréquents de pluie et neige mêlées ou grésil';
			break;
		case 140:
			descriptionWeather = 'Pluies orageuses';
			break;
		case 141:
			descriptionWeather = 'Pluie et neige mêlées à caractère orageux';
			break;
		case 142:
			descriptionWeather = 'Neige à caractère orageux';
			break;
		case 210:
			descriptionWeather = 'Pluie faible intermittente';
			break;
		case 211:
			descriptionWeather = 'Pluie modérée intermittente';
			break;
		case 212:
			descriptionWeather = 'Pluie forte intermittente';
			break;
		case 220:
			descriptionWeather = 'Neige faible intermittente';
			break;
		case 221:
			descriptionWeather = 'Neige modérée intermittente';
			break;
		case 222:
			descriptionWeather = 'Neige forte intermittente';
			break;
		case 230:
			descriptionWeather = 'Pluie et neige mêlées';
			break;
		case 231:
			descriptionWeather = 'Pluie et neige mêlées';
			break;
		case 232:
			descriptionWeather = 'Pluie et neige mêlées';
			break;
		case 235:
			descriptionWeather = 'Averses de grêle';
			break;

		default:
			descriptionWeather = '';
	}

	return descriptionWeather;
}
