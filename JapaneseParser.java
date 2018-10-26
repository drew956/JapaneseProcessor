/**
 * Kuromoji belongs to Atilika Inc, and I make no claim to their code.
 * I am merely using it in my project.
 * 
 * Please see the license under which Kuromoji has been shared:  http://www.apache.org/licenses/LICENSE-2.0
 * 
 */
package org.atilika.kuromoji.example;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.atilika.kuromoji.Token;
import org.atilika.kuromoji.Tokenizer;
import org.atilika.kuromoji.Tokenizer.Mode;

public class JapaneseParser {

	public static void main(String[] args) throws IOException {
		Tokenizer tokenizer;
		if (args.length == 1) {
			Mode mode = Mode.valueOf(args[0].toUpperCase());
			tokenizer = Tokenizer.builder().mode(mode).build();
		} else if (args.length == 2) {
			Mode mode = Mode.valueOf(args[0].toUpperCase());
			tokenizer = Tokenizer.builder().mode(mode).userDictionary(args[1]).build();
		} else {
			tokenizer = Tokenizer.builder().build();
		}
		System.out.println("Tokenizer ready.  Provide input text and press RET.");
		BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));
		String line;
		/* 
		    Each line represents its own chunk of data that needs to be parsed and spat out properly
		    Things to be considered:
		        How do we pull out particles?
		        Clean-up comes later right?
		        Do we want it to be in JSON format?
		        How about what format would be best for a MYSQL database?
		        
		        
		*/
		ArrayList<String> particles = new ArrayList<String>();
		ArrayList<String> words     = new ArrayList<String>();
		
		String patternString = "([一-龯ぁ-ゔゞァ-・ヽヾ゛゜ー、。「」\\w]+)[^一-龯ぁ-ゔゞァ-・ヽヾ゛゜ー\\w]+.+";        
		Pattern pattern = Pattern.compile(patternString);
        Matcher matcher; 

        /* 
         * Could have and should have simply split on \t LOL
         * */
        while ((line = reader.readLine()) != null) {
			List<Token> result = tokenizer.tokenize(line);
			for (Token token : result) {
    			
    			String output = token.getSurfaceForm() + "\t" + token.getAllFeatures();
    			//System.out.println(output);
    			/* 
    			    Check if it is a particle or not.
    			*/
    			matcher = pattern.matcher(output);
    			String match = (matcher.lookingAt() && matcher.groupCount() >= 1) ? 
    					matcher.group(1) :
    					"ERROR THE PATTERN FAILED";
    			
    			if(output.contains("助詞") ){
    				particles.add(match);
    			}else {
    				words.add(match);
    			}
			}
			formatAndOutputText(line, words, particles);
			particles.clear();
			words.clear();
		}
	}
	private static String getFormattedString(ArrayList<String> words) {
		String result = "";
		result += "    {\n";
		for(String word : words) {
			result += "        \"" + word + "\",\n";
		}
		result += "    }";
		return result;
	}
	private static void formatAndOutputText(String line, ArrayList<String> words, ArrayList<String> particles) {
		System.out.println(
				"{\n    \"" + 
						  line + "\","
		);
		System.out.println(
			getFormattedString(words) + ","
		);
		System.out.println(
			getFormattedString(particles)
		);
		System.out.println(
				"}"
		);

	}
}
























